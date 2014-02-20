<?php
class DefaultController extends Controller
{
    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    public function filters()
    {
        return array(
            array('UserFilter')
        );
    }

    /**
     * Список
     */
	public function actionIndex($status = '')
	{
		Yii::app()->getModule('tenders');
		$model = Sbs::model()->my();
		if( $status == Sbs::STATUS_NEW ) {
			$model = $model->renewed();
		} elseif( $status == Sbs::STATUS_ACTIVE ) {
			$model = $model->active();
		} elseif( $status == Sbs::STATUS_COMPLETE ) {
			$model = $model->completed();
		} elseif( $status == Sbs::STATUS_CLOSE ) {
			$model = $model->closed();
		}

		$dataProvider = new CActiveDataProvider($model, array(   
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'date' => true
				),
				'attributes' => array(
					'date'
				)
			),
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => 20,
			),
		));
		$countAll = new Sbs;
		$countAll = $countAll->my()->count();

		$countNew = new Sbs;
		$countNew = $countNew->my()->renewed()->count();

		$countActive = new Sbs;
		$countActive = $countActive->my()->active()->count();

		$countCompleted = new Sbs;
		$countCompleted = $countCompleted->my()->completed()->count();

		$countClosed = new Sbs;
		$countClosed = $countClosed->my()->closed()->count();

		$renderdata = array(
			'dataProvider' => $dataProvider,
			'countAll' => $countAll,
			'countNew' => $countNew,
			'countActive' => $countActive,
			'countCompleted' => $countCompleted,
			'countClosed' => $countClosed
		);
		$this->pageTitle = 'Сервис безопасной сделки';
		$this->render('index', $renderdata);
	}

    /**
     * Просмотр
     */
	public function actionShow($id = '')
	{
		Yii::app()->getModule('tenders');
    	$model = Sbs::model()->with(array('customer', 'performer', 'project'))->my()->findByPk($id);
    	if( !$model ) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		$renderdata = array(
			'model' => $model,
			'comment' => new SbsLetters,
            'work' => New SbsWork,
		);
		$this->pageTitle = 'Сервис безопасной сделки';
    	$this->render('show', $renderdata);
	}

    /**
     * Завершить сделку
     */
	public function actionComplete($id = '')
	{
		Yii::app()->getModule('tenders');
    	$model = Sbs::model()->findByPk($id);
    	if( !$model ) {
			throw new CHttpException(410, 'Сделка не найдена!');
		}
		if( $model->customer_id != Yii::app()->user->id ) {
			throw new CHttpException(410, 'Сделки могут завершаться только пользователем заказчиком!');
		}
        //if( $model->status != Sbs::STATUS_ACTIVE ) { // только начатые сделки
    	if ($model->status != Sbs::STATUS_DONE) { // только сделки со сданной работой
			throw new CHttpException(410, 'Завершаться могут только сделки со сданной работой!');
		}
		if( Yii::app()->request->isPostRequest && !empty($_POST['complete']) ) 
        {
			/*$model->status = Sbs::STATUS_COMPLETE;
			if( $model->validate() ) {
				$transaction = Yii::app()->db->beginTransaction();// начало транзакции
				try {
					$model->save();
					Balance_helper::change($model->performer_id, $model->amount, 'Платеж получен');
					$transaction->commit();
					$this->redirect('/sbs');
				} catch(Exception $e) {
					$transaction->rollback();
					Yii::log("При завершении сделки возникла ошибка! - ".$e->getMessage()."", CLogger::LEVEL_ERROR);  
				}
			}*/
            if ($model->complete()) {
                $this->redirect('/sbs/' . $model->id);
            } else {
                throw new CHttpException(410, 'При завершении сделки возникли ошибки');
            }
		}
		$renderdata = array(
			'model' => $model
		);
		$this->pageTitle = 'Завершить сделку';
    	$this->render('complete', $renderdata);
	}

    /**
     * Подать жалобу в арбитраж
     */
	public function actionArbitration($id = '')
	{
		Yii::app()->getModule('tenders');
    	$model = Sbs::model()->findByPk($id);
		$user = $this->loadModel();
    	if (!$model ) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		if ($model->customer_id != Yii::app()->user->id and $model->performer_id != Yii::app()->user->id ) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
    	if ($model->status != Sbs::STATUS_DONE) { // только сделки на гарантии
			throw new CHttpException(404, 'The requested page does not exist.');
		}
    	if ($model->status == Sbs::STATUS_DISPUTE ) { // если жалоба уже подана
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		$arbitration = new SbsArbitration;
		if( Yii::app()->request->isPostRequest && !empty($_POST['SbsArbitration'])) {
			$arbitration->setAttributes($_POST['SbsArbitration']);   
			$arbitration->sbs_id = $id;
			if( $arbitration->validate() )
			{
				$transaction = Yii::app()->db->beginTransaction();// начало транзакции
				try {
					$arbitration->save();
					$model->status = Sbs::STATUS_DISPUTE;
                    if($success = $model->save()) { // +отправить письмо автору блога, если комментарий добавлен другим пользователем
                        $userFrom = Yii::app()->user->id == $model->customer->id ? $model->customer : $model->performer;
                        $userTo   = Yii::app()->user->id == $model->customer->id ? $model->performer : $model->customer;
                        new Events_helper($userTo->id, $userFrom->id, Events_helper::NOTIFY_SBSDISPUTE, $model->id);  //запись события
                        //отсылка емейла
                        Email_helper::send($userTo->email, 'На Вас подали жалобу в арбитраж на сайте ' . Yii::app()->name . '', 'newSbsDispute', array(
                            'sbs'=>$model, 
                            'userFrom'=>$userFrom,
                            'userTo'=>$userTo,
                        ));
                        Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Жалоба в арбитраж подана');
                    } else {
                        throw new CException(410, 'При подаче жалобы в арбитраж возникла ошибка!');
                    }
                    $transaction->commit();
					$this->redirect('/sbs/' . $model->id);
				} catch(Exception $e) {
					$transaction->rollback();
					Yii::log("При подаче жалобы в арбитраж возникла ошибка! - ".$e->getMessage()."", CLogger::LEVEL_ERROR);  
				}
			}
		}
		$renderdata = array(
			'model' => $model,
			'arbitration' => $arbitration
		);
		$this->pageTitle = 'Подать жалобу в арбитраж';
    	$this->render('arbitration', $renderdata);
	}

    /**
     * Зарезервировать
     */
	public function actionReserve($id = '', $action = '')
	{
		Yii::app()->getModule('tenders');
    	$model = Sbs::model()->with(array('customer', 'performer'))->findByPk($id);
		$user = $this->loadModel();
    	if( !$model ) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		if( $model->customer_id != Yii::app()->user->id ) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
    	if( $model->status != Sbs::STATUS_NEW && $model->status != Sbs::STATUS_WAITRESERV) { // только новые сделки .... а также ОЖИДАЮЩИЕ
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		if( $model->amount > $user->balance ) {
			$balance = FALSE;
			Yii::app()->user->setFlash(FlashMessages::ERROR, 'На вашем счету недостаточно средств, пополните баланс');
		} else {
			$balance = TRUE;
			Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Вы можете зарезервировать сделку, с вашего баланса будет списано '.$model->amount.' рублей');
		}
		if( Yii::app()->request->isPostRequest && !empty($_POST['reserve']) && $balance == TRUE ) {
			$model->status = Sbs::STATUS_ACTIVE;
			if( $model->validate() ) {
				$transaction = Yii::app()->db->beginTransaction();// начало транзакции
				try {
					$model->save();
					Balance_helper::change(Yii::app()->user->id, -$model->amount, 'Резервируем');
					$transaction->commit();
                    //запись события
                    new Events_helper($model->customer->id, $model->customer->id, Events_helper::NOTIFY_SBSRESERVED, $model->id);
                    //отсылка емейла
                    Email_helper::send($model->performer->email, 'Заказчик оплатил заказ на сайте ' . Yii::app()->name . '', 'newSbsReserved', array('sbs'=>$model));
					//редиректим на страницу сделки
                    $this->redirect('/sbs/' . $model->id);
				} catch(Exception $e) {
					$transaction->rollback();
					Yii::log("При резервирование средств позникла ошибка! - ".$e->getMessage()."", CLogger::LEVEL_ERROR);  
				}
			}
		}
		$renderdata = array(
			'model' => $model,
			'balance' => $balance
		);
		$this->pageTitle = 'Зарезервировать средства';
    	$this->render('reserve', $renderdata);
	}

    
    //сохранить файлы при сдаче работы / внесении правок
    private function saveWorkFiles($sbswork) {
        $attachments = CUploadedFile::getInstancesByName('attachments');  //извлекаем прикрепл-е файлы
        if( isset($attachments) && count($attachments) > 0 ) {
            $savedir = '.' . Yii::app()->getModule('sbs')->workAttachmentsDir;  //путь для сохранения файлов
            foreach ($attachments as $attachment)    {  //цикл по файлам в аттачменте
                $sourcePath = pathinfo($attachment->name);    
                $fileName = md5(time()).'.'.$sourcePath['extension'];
                $path = $savedir . $fileName;           //полный путь к загружаемому файлу
                if($attachment->saveAs($path) ) {   //пробуем сохранить файл
                    $attachment_add = new SbsWorkFile();
                    $attachment_add->sbswork_id = $sbswork->id;          //ссылка на сданную работу
                    $attachment_add->filename = $fileName;               //сгенерённое имя файла
                    $attachment_add->origname = $attachment->name;       //оригинальное имя файла
                    $attachment_add->type = $sourcePath['extension'];    //тип файла = расширение
                    $attachment_add->size = $attachment->size;           //размер файла
                    if (!$attachment_add->save()) {  //пробуем сохранить запись в БД для файла
                        $filesSuccess = false;
                    }
                } else {
                    $filesSuccess = false;
                }
            }
        }
    }
    
    /**
     * Сдать работу
     */
    public function actionDone($id = '') {
        $sbs_id = !empty($id) ? $id : $_POST['sbs_id'];
        //проверить: есть ли сделка с таким ИД
        if (!$sbs_id || !($model = Sbs::model()->with(array('project', 'customer', 'performer'))->findByPk($sbs_id))) {
            throw new CHttpException(404, 'The requested page does not exist.');
        } else {
            //сохраняем запись в таблицу сданных работ/правок
            $sbswork = New SbsWork();
            $sbswork->sbs_id = $sbs_id;
            $sbswork->type = $_POST['type'];
            $sbswork->text = $_POST['SbsWork']['text'];
            if ($sbswork->validate()) {
                $transaction = Yii::app()->db->beginTransaction();// начало транзакции
                try {
                    if ($success = $sbswork->save()) {  //если успешно сохранена запись о сдаче работы
                        $this->saveWorkFiles($sbswork); //сохранить файлы
                        /*$attachments = CUploadedFile::getInstancesByName('attachments');  //извлекаем прикрепл-е файлы
                        if( isset($attachments) && count($attachments) > 0 ) {
                            foreach ($attachments as $attachment)    {  //цикл по файлам в аттачменте
                                $sourcePath = pathinfo($attachment->name);    
                                $fileName = md5(time()).'.'.$sourcePath['extension'];
                                $path = '.'.Yii::app()->getModule('sbs')->workAttachmentsDir.$fileName;
                                if($attachment->saveAs($path) ) {   //пробуем сохранить файл
                                    $attachment_add = new SbsWorkFile();
                                    $attachment_add->sbswork_id = $sbswork->id;          //ссылка на сданную работу
                                    $attachment_add->filename = $fileName;               //сгенерённое имя файла
                                    $attachment_add->origname = $attachment->name;       //оригинальное имя файла
                                    $attachment_add->type = $sourcePath['extension'];    //тип файла = расширение
                                    $attachment_add->size = $attachment->size;           //размер файла
                                    if (!$attachment_add->save()) {  //пробуем сохранить запись в БД для файла
                                        $filesSuccess = false;
                                    }
                                } else {
                                    $filesSuccess = false;
                                }
                            }
                        } */
                    }
                    //сохраняем новый статус сделки
                    $model->status = Sbs::STATUS_DONE;  //поставить статус сделки "работа выполнена"
                    $success = $model->save();          //сохраняем модель
                    if ($success) {
                        new Events_helper($model->customer->id, $model->performer->id, Events_helper::NOTIFY_SBSDONE, $model->id); //запись события
                        Email_helper::send($model->customer->email, 'Исполнитель сдал работу на сайте ' . Yii::app()->name . '', 'newSbsDone', array('sbs'=>$model)); //отсылка емейла
                    } else {
                        throw new CException(404, 'Ошибка сохранения сделки');
                    }

                    $transaction->commit();
                    //$this->redirect(Yii::app()->createAbsoluteUrl('sbs/' . $model->id)); //переход на страницу сделки (заказа)
                } catch(Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash(FlashMessages::ERROR, 'При сдаче работы возникла ошибка!');
                    Yii::log("При сдаче работы возникла ошибка! - ".$e->getMessage()."", CLogger::LEVEL_ERROR);  
                }
            }
            $this->redirect(Yii::app()->createAbsoluteUrl('sbs/' . $model->id)); //переход на страницу сделки (заказа)
        }
    }

    /**
     * Внести правки / выслать правки
     */
    public function actionSendWork($id = '') {
        $sbs_id = !empty($id) ? $id : $_POST['sbs_id'];
        //проверить: есть ли сделка с таким ИД
        if (!$sbs_id || !($model = Sbs::model()->with(array('project', 'customer', 'performer'))->findByPk($sbs_id))) {
            throw new CHttpException(404, 'The requested page does not exist.');
        } else {
            //сохраняем запись в таблицу сданных работ/правок
            $sbswork = New SbsWork();
            $sbswork->sbs_id = $sbs_id;
            $sbswork->type = $_POST['type'];
            $sbswork->text = $_POST['SbsWork']['text'];
            if ($sbswork->validate()) {
                $transaction = Yii::app()->db->beginTransaction();// начало транзакции
                try {
                    if ($success = $sbswork->save()) {  //если успешно сохранена запись о сдаче работы
                        $this->saveWorkFiles($sbswork); //сохранить файлы
                        new Events_helper($model->customer->id, $model->performer->id, Events_helper::NOTIFY_SBSDONE, $model->id); //запись события
                        Email_helper::send($model->customer->email, 'Исполнитель сдал работу на сайте ' . Yii::app()->name . '', 'newSbsDone', array('sbs'=>$model)); //отсылка емейла
                    } else {
                        throw new CException(404, 'Ошибка сохранения работы');
                    }
                    $transaction->commit();
                    //$this->redirect(Yii::app()->createAbsoluteUrl('sbs/' . $model->id)); //переход на страницу сделки (заказа)
                } catch(Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash(FlashMessages::ERROR, 'При завершении сделки возникла ошибка!');
                    Yii::log("При завершении сделки возникла ошибка! - ".$e->getMessage()."", CLogger::LEVEL_ERROR);  
                }
            }
            $this->redirect(Yii::app()->createAbsoluteUrl('sbs/' . $model->id)); //переход на страницу сделки (заказа)
        }
    }
        
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @return User
     */
	public function loadModel()
	{
		if( $this->_model === null ) {
			if( Yii::app()->user->isAuthenticated() ) { // если пользователь авторизирован
				$this->_model = User::model()->findbyPk(Yii::app()->user->id);
			}
			if( $this->_model === null ) {
				throw new CHttpException(404, 'The requested page does not exist.');
			}
        }
        return $this->_model;
    }

    /**
     * Новая сделка
     */
	public function actionPublication($id = '')
	{
		Yii::app()->getModule('tenders');
		//проверить: есть ли проект с таким ИД
        if( $id ) { // проект
	    	$tender = Tenders::model()->with(array('bidslist', 'sbs'))->findByPk($id);
			if( !$tender ) {
				throw new CHttpException(404, 'The requested page does not exist.');
			}
			if( !Yii::app()->user->checkAccess('deleteContact', array('contact' => $tender)) ) {
				throw new CHttpException(404, 'The requested page does not exist.');
			}
		} else  {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
        
        //проверить: выбрал ли заказчик исполнителя на проект 
        if (isset($tender->sbs)) {
            if ($tender->sbs->status == Sbs::STATUS_COMPLETE) {
                throw new CHttpException(404, 'Сделка по данному проекту завершена');
            } else if ($tender->sbs->status != Sbs::STATUS_REJECT) {
                if ($tender->sbs->status == Sbs::STATUS_NEW) {
                    $this->pageTitle = 'Ожидание подтверждения исполнителем';
                    $message = 'Исполнителю <strong>' . $tender->sbs->performer->nickName . '</strong> отправлена информация о предложенной Вами сделке. Ожидайте подтверждения в ближайшее время';
                } else if ($tender->sbs->status == Sbs::STATUS_WAITRESERV) {
                    $this->pageTitle = 'Ожидание резервирования суммы заказчиком';
                    $message = 'Необходимо зарезервировать сумму для сделки';
                }
                $this->render('waitoffer', array(
                    'url'=>Yii::app()->createAbsoluteUrl('sbs/' . $tender->sbs->id),
                    'message'=>$message,
                ));
                Yii::app()->end();
            }
        }
        
		$model = new Sbs;   //новый объект сделки
		if( Yii::app()->request->isPostRequest && !empty($_POST['Sbs']) ) {//если был сабмит формы
			$model->setAttributes($_POST['Sbs']);     //занести атрибуты  
			if( $model->validate() ) {     //если проверка модели УСПЕШНА
                
                $performer = null;
                $model->project_id = $id;   //ссылка на проект
                //разбираемся с заявками 
                if( $accept = $tender->checkABid() ) {// если уже была принята заявка, то прошлую заявку в статус актив
                    $accept->status = Bids::STATUS_ACTIVE;
                    $accept->save();
                }
                foreach($tender->bidslist as $bid) { //находим выбранную заявку
                    if ($bid->user_id == $_POST['Sbs']['performer_id']) {
                        $bid->status = Bids::STATUS_ACCEPT;  //для новой заявки ставим статус ПРИНЯТО
                        $bid->update();
                        $performer = $bid->userdata;
                        break;
                    }
                }
                //у заказа (проекта) ставим статус "КОНКУРС ЗАВЕРШЁН"
                if ($tender->status != Tenders::STATUS_ENDED) {
                    $tender->status = Tenders::STATUS_ENDED;
                    $success = $tender->save();
                }

                //удаляем объект сделки, связанный с данным заказом, если таковой уже есть
                // (например, если предыдущий выбранный исполнитель отказался от предложения)
                //!TODO... может в дальнейшем отражать предложение заказчика исполнителю не в сделке, а в предложении (модель Bid)
                if (isset($tender->sbs)) {
                    $tender->sbs->delete();
                }

                //сохраняем СБС
				if ($success = $model->save()) {
                    if (!isset($performer)) {  //определить юзера - исполнителя
                         $performer = User::model()->findByPk($_POST['Sbs']['performer_id']);
                    }
                    //запись события
                    new Events_helper($customer->id, $customer->id, Events_helper::NOTIFY_NEWSBSOFFER, $model->id);
                    //отсылка емейла
                    Email_helper::send($performer->email, 'Вам предложена сделка по проекту на сайте ' . Yii::app()->name . '', 'newSbsOffer', array('sbs'=>$model));
                    //вывести страничку о начале сделки
                    $this->pageTitle = 'Создана новая сделка по проекту ' . $tender->title;
                    $this->render('waitoffer', array(
                        'url'=>Yii::app()->createAbsoluteUrl('sbs/' . $model->id),
                        'sbs'=>$model
                    ));   
                    Yii::app()->end();
                    //$this->redirect('/sbs');
                }
			}
		}
		$this->pageTitle = 'Новая сделка';
		$this->render('publication', array('model' => $model, 'tender' => $tender));
	}

    /**
    * -- Подтверждение исполнителем приглашения на участие в проекте (исп-ль соглашается на заказ)
    * 
    */
    public function actionConfirm($id = null) {
        //проверить: есть ли сделка с таким ИД
        if (!$id || !($model = Sbs::model()->with(array('project', 'customer', 'performer'))->findByPk($id))) {
            throw new CHttpException(404, 'The requested page does not exist.');
            //if( !Yii::app()->user->checkAccess('deleteContact', array('contact' => $tender)) ) {
            //    throw new CHttpException(404, 'The requested page does not exist.');
            //}
        } else {
            $model->status = Sbs::STATUS_WAITRESERV;  //поставить статус сделки "ждёт пополнения денег"
            if ($success = $model->save()) {
                //$model->project->status = Tenders::STATUS_WAITRESERV;  //такой же статус поставить в модель заказа
                //$model->project->save();      //(скорее для совместимости... потом возможно убрать это для модели заказа)
                //запись события
                new Events_helper($model->customer->id, $model->performer->id, Events_helper::NOTIFY_NEWSBSCONFIRM, $model->id);
                //отсылка емейла
                Email_helper::send($model->customer->email, 'Исполнитель согласился на Ваше предложение по проекту на сайте ' . Yii::app()->name . '', 'newSbsConfirm', array('sbs'=>$model));
                //переход на страницу заказа
                $url = Yii::app()->createAbsoluteUrl('sbs/' . $model->id);
                //$url = Yii::app()->createAbsoluteUrl('tenders/' . $model->project->id . '.html');
                $this->redirect($url);
            } else {
                throw new CHttpException(410, 'Ошибка при сохранении статуса сделки');
            }
        }
    }

    /**
    * -- Отказ исполнителя от приглашения на участие в проекте (исп-ль соглашается на заказ)
    * 
    */
    public function actionReject($id = null) {
        //проверить: есть ли сделка с таким ИД
        if (!$id || !($model = Sbs::model()->with(array('project', 'customer', 'performer'))->findByPk($id))) {
            throw new CHttpException(404, 'The requested page does not exist.');
        } else {
            $model->status = Sbs::STATUS_REJECT;  //поставить статус сделки "исполнитель отказался"
            if ($success = $model->save()) {
                $model->project->status = Tenders::STATUS_OPEN;  //в модель заказа поставить статус "ОТКРЫТ", чтобы другие иполнители могли давать ответ на заказ
                $model->project->save();      //(скорее для совместимости... потом возможно убрать это для модели заказа) ????????
                //разбираемся с заявками 
                foreach($model->project->bidslist as $bid) { //находим выбранную заявку
                    if ($bid->user_id == Yii::app()->user->id) {
                        $bid->status = Bids::STATUS_REJECT;  //для новой заявки ставим статус ПРИНЯТО
                        $bid->update();
                        break;
                    }
                }
                //запись события
                new Events_helper($model->customer->id, $model->performer->id, Events_helper::NOTIFY_NEWSBSREJECT, $model->id);
                //отсылка емейла
                Email_helper::send($model->customer->email, 'Исполнитель отказался от проекта на сайте ' . Yii::app()->name . '', 'newSbsReject', array('sbs'=>$model));
                //переход на страницу заказа
                $url = Yii::app()->createAbsoluteUrl('sbs/' . $model->id);
                //$url = Yii::app()->createAbsoluteUrl('tenders/' . $model->project->id . '.html');
                $this->redirect($url);
            } else {
                throw new CHttpException(410, 'Ошибка при сохранении статуса сделки');
            }
        }
    }
    
    /**
     * Отменить сделку
     */
	function actionClose($id)
	{
		$model = Sbs::model()->findByPk($id);
		if( !$model ) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		if( $model->customer_id != Yii::app()->user->id ) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		$model->status = Sbs::STATUS_CLOSE;
		$model->update();
		$this->redirect('/sbs');
	}

    /**
     * Добавить комментарий
     */
	public function actionAddComment()
	{
		$sbs_id = $_POST['sbs_id'];
		$sbs = Sbs::model()->findByPk($sbs_id);
		if( !$sbs ) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		$model = new SbsLetters;
		if( Yii::app()->request->isPostRequest ) {
			$model->setAttributes(array(
				'sbs_id' => $sbs_id,
				'text' => $_POST['SbsLetters']['text']
			)); 
			if($success = $model->save()) { // +отправить письмо автору блога, если комментарий добавлен другим пользователем
                $userFrom = Yii::app()->user->id == $sbs->customer->id ? $sbs->customer : $sbs->performer;
                $userTo   = Yii::app()->user->id == $sbs->customer->id ? $sbs->performer : $sbs->customer;
                new Events_helper($userTo->id, $userFrom->id, Events_helper::SENT_MESSAGES, $sbs->id);  //запись события
                //отсылка емейла
                Email_helper::send($userTo->email, 'Вам пришло Новое сообщение по проекту на сайте ' . Yii::app()->name . '', 'newSbsLetter', array(
                    'sbsLetter'=>$model, 
                    'userFrom'=>$userFrom,
                    'userTo'=>$userTo,
                ));
				Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Комментарий добавлен');
				$this->redirect('/sbs/'.$sbs_id);                   
			} else {
                throw new CHttpException(410, 'Ошибка при отправке сообщения');
            }
		}
	}
}