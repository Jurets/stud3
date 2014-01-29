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
			'comment' => new SbsLetters
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
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		if( $model->customer_id != Yii::app()->user->id ) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
    	if( $model->status != Sbs::STATUS_ACTIVE ) { // только начатые сделки
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		if( Yii::app()->request->isPostRequest && !empty($_POST['complete']) ) {
			$model->status = Sbs::STATUS_COMPLETE;
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
	{//DebugBreak();
		Yii::app()->getModule('tenders');
    	$model = Sbs::model()->findByPk($id);
		$user = $this->loadModel();
    	if( !$model ) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		if( $model->customer_id != Yii::app()->user->id and $model->performer_id != Yii::app()->user->id ) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
    	if( $model->status != Sbs::STATUS_ACTIVE ) { // только начатые сделки
			throw new CHttpException(404, 'The requested page does not exist.');
		}
    	if( $model->status != Sbs::STATUS_ACTIVE ) { // если жалоба уже подана
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		$arbitration = new SbsArbitration;
		if( Yii::app()->request->isPostRequest && !empty($_POST['SbsArbitration']))
        {
			$arbitration->setAttributes($_POST['SbsArbitration']);   
			$arbitration->sbs_id = $id;
			if( $arbitration->validate() )
			{
				$transaction = Yii::app()->db->beginTransaction();// начало транзакции
				try {
					$arbitration->save();
					$model->status = Sbs::STATUS_DISPUTE;
					$model->save();
					$transaction->commit();
		
					$this->redirect('/sbs');
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

    /**
     * Сдать работу
     */
    public function actionDone($id = '') {
        //проверить: есть ли сделка с таким ИД
        if (!$id || !($model = Sbs::model()->with(array('project', 'customer', 'performer'))->findByPk($id))) {
            throw new CHttpException(404, 'The requested page does not exist.');
        } else {
            $model->status = Sbs::STATUS_DONE;  //поставить статус сделки "исполнитель отказался"
            if ($success = $model->save()) {
                //запись события
                new Events_helper($model->customer->id, $model->performer->id, Events_helper::NOTIFY_SBSDONE, $model->id);
                //отсылка емейла
                Email_helper::send($model->customer->email, 'Исполнитель сдал работу на сайте ' . Yii::app()->name . '', 'newSbsDone', array('sbs'=>$model));
                //переход на страницу заказа
                $url = Yii::app()->createAbsoluteUrl('sbs/' . $model->id);
                $this->redirect($url);
            } else {
                throw new CHttpException(410, 'Ошибка при сохранении статуса сделки');
            }
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
			if( $model->validate() ) {//DebugBreak();     //если проверка модели УСПЕШНА
                
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
    * -- Подтверждение исполнителем приглашения на участие в проекте (исп-ль соглашается на заказ)
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
			if( $model->validate()) { // +отправить письмо автору блога, если комментарий добавлен другим пользователем
				$model->save();
				Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Комментарий добавлен');
				$this->redirect('/sbs/default/show/?id='.$sbs_id);                   
			}
		}
	}
}