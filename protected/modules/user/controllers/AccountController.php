<?php
class AccountController extends Controller
{
    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    public $fullness;// заполненность профиля

    public $guests;// гости

    /**
     * Фильтры
     */
    public function filters()
    {
        return array(
			'ajaxOnly + requests, LoadCrop, json, crop, SendToEmail',// только ajax запросы
			array('UserFilter'),
        );
    }

    /**
     * Аккаунт
     */
	public function actionIndex() 
	{
		$this->redirect('/account/profile');
	}

    /**
     * Тарифный план
     */
    public function actionTariff()
    {
        $user = $this->loadModel();
        if( $user->tariff == Tariffs::PRO ) {
            $UsersTariff = UsersTariff::model()->findByPk($user->id);
        }
        $SetTariff = new SetTariff;
        $model = new Tariffs;
        if( Yii::app()->request->isPostRequest && !empty($_POST['SetTariff']) ) {
            $SetTariff->setAttributes($_POST['SetTariff']);       
            if( $SetTariff->validate() )// если прошли валидацию - минусуем баланс
            {
                $transaction = Yii::app()->db->beginTransaction();// начало транзакции
                try {
                    $tariff = Tariffs::model()->findbyPk(Tariffs::PRO);
                    $amount = $tariff->getPrice($SetTariff->period);
                    Balance_helper::change(Yii::app()->user->id, -$amount, 'Оплата PRO');
                    Tariffs_helper::changeTariff(Yii::app()->user->id, $SetTariff->period);
                    $transaction->commit();
                    $this->redirect('/account/tariff');
                } catch(Exception $e) {
                    $transaction->rollback();
                    Yii::log("При установке тарифного плана произошла ошибка! - ".$e->getMessage()."", CLogger::LEVEL_ERROR);  
                    $model->addError('period', 'При установке тарифного плана произошла ошибка!');
                }
            }
        }
        $data = Tariffs::model()->getAll();
        $this->pageTitle = 'Тарифный план';
        $renderdata = array(
            'user' => $user,
            'model' => $model,
            'SetTariff' => $SetTariff,
            'data' => $data,
            'UsersTariff' => $UsersTariff
        );
        $this->render('tariff', $renderdata);
    }

    /**
     * Специализации 
     */
	public function actionServices()
	{
		if( Yii::app()->request->isPostRequest )
        {
			Services::deleteServices();
			$services = $_POST['services'];
			if( !empty($services) ) {
				foreach ( $services as $row => $value ) {
					$model = new Services;
					$model->category = $value;
					$model->save();
				}
			}
			$this->refresh();// обновляем страницу
		}
		$categories = Categories::getCategories();
		$services = Services::getServices();
		$this->pageTitle = 'Услуги';
		$this->render('services', array('categories' => $categories, 'services' => $services));
	}

    /**
     * Изменение пароля
     */
	public function actionChangepassword()
	{
		$model = $this->loadModel();

		$form = new ChangePasswordForm;

		if( Yii::app()->request->isPostRequest && !empty($_POST['ChangePasswordForm']) )
		{
			$form->setAttributes($_POST['ChangePasswordForm']);

			if( $form->validate() )// если форма прошла валидацию
			{
				$model->changePassword($form->password);// меняем пароль

				Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Изменения успешно сохранены');

				$this->refresh();// обновляем страницу
			}
		}

		$this->pageTitle = 'Пароль';

		$this->render('changepassword', array('model' => $form, 'changePasswordForm' => $form));
	}

    /**
     * Изменение профиля
     */
	public function actionProfile()
	{
		$model = $this->loadModel();
		$model->setScenario('profile');
		if( Yii::app()->request->isPostRequest && !empty($_POST['User']) ) {
			$model->attributes = $_POST['User'];
			if( $model->validate() ) {
				$model->save();
				Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Изменения успешно сохранены');
				$this->refresh();
			}
		}
		$this->pageTitle = 'Личные данные';
		$this->render('profile', array('model' => $model, 'country' => $country, 'city' => $city));
	}

    //
	public function actionJson()
	{
		if( isset($_GET['tag']) ) {
			$criteria = new CDbCriteria(array(
				'limit' => 10
			));
			$criteria->addSearchCondition('name', $_GET['tag']);
			$tags = Interests::model()->findAll($criteria);            
			$this->renderPartial('json', array('tags' => $tags));
		}
	}
    
    //Тариф
    /*public function actionExpiredTariffs()
    {
        $start = time() - 604800;// неделю назад
        $end = time();// сейчас
        $query =
            " SELECT id, email, name, surname".
            " FROM `ci_users`".
            " WHERE ci_users.`id` IN (SELECT user_id FROM ci_guests WHERE `update` > $start and `update` < $end)".
            " GROUP BY ci_users.`id`;";
        $command = Yii::app()->db->createCommand($query);
        $users = $command->queryAll();
        return $users;
    }*/
        
    /**
     * Оповещение
     */
    public function actionNotify()
    {
        $model = UsersNotify::model()->user()->find();
        if( !$model ) { // ЗАГЛУША, В БАЗЕ НЕТУ ОПОВЕЩЕНИЙ
            $notify = new UsersNotify; // оповещения
            $notify->user_id = Yii::app()->user->id;
            $notify->save();
            $this->refresh();
        }
        if( Yii::app()->request->isPostRequest && !empty($_POST['UsersNotify']) ) {
            $model->setAttributes($_POST['UsersNotify']);
            if( $model->validate() ) {
                $model->save();
                Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Изменения успешно сохранены');
                $this->refresh();
            }
        }
        $this->pageTitle = 'Оповещения';
        $this->render('notify', array('model' => $model));
    }
        
        
    /**
     * Резюме
     */
    public function actionResume()
    {
        $model = $this->loadModel();
        $model->setScenario('profile');
        if( Yii::app()->request->isPostRequest && !empty($_POST['User']) )
        {
            $model->attributes = $_POST['User'];
            if( $model->validate() )
            {
                $model->full_descr_v = Yii::app()->decoda->parse($model->full_descr);
                $model->save();
                Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Изменения успешно сохранены');
                $this->refresh();
            }
        }
        $country = Country::model()->findAll();
        $city = City::model()->findAll('country_id = :country_id', array(':country_id' => $model->country));
        $this->pageTitle = 'Личные данные';
        $this->render('resume', array('model' => $model, 'country' => $country, 'city' => $city));
    }    
    
    /**
     * Навыки
     */
    public function actionSkills()
    {
        $model = $this->loadModel();
        if( Yii::app()->request->isPostRequest ) {
            $model->setTags($_POST['Tags']);// сохраняем интерены
            $model->save();
            Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Изменения успешно сохранены');
            $this->refresh();
        }
        $this->pageTitle = 'Навыки';
        $this->render('skills', array('model' => $model));
    }    
    
    /**
     * Загрузка юзерпика
     */
	public function actionUserpic()
	{
		header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
		$model = $this->loadModel();
		$model->setScenario('userpic');
		$oldUserpic_f = $model->userpic_f;
		$oldUserpic = $model->userpic;
		if( Yii::app()->request->isPostRequest && !empty($_POST['User']) )
		{
			$model->_userpic = CUploadedFile::getInstance($model, 'userpic');
			if( $model->validate() and $model->_userpic )// если форма прошла валидацию и загружен юзерпик
			{
				$extension = pathinfo($model->_userpic->getName(), PATHINFO_EXTENSION);
				$fileName = md5(time()).'.'.$extension;
				$name = Yii::app()->getModule('user')->userpicPrefix.Randomness::randomString(10).'.'.$extension;
				$model->userpic_f = $fileName;// полный юзерпик в профиль
				$model->userpic = $name;// уменьшенная копия
				if( $model->save() ) {
					// юзерпик в профиль
					$path = '.'.Yii::app()->getModule('user')->userpicsDir.$fileName;
					$model->_userpic->saveAs($path);
					$image = Yii::app()->image->load($path);
					if( $image->width > 200 ) {// если ширина больше 200, то сжимаем до 200
						$image->resize(200, NULL, Image::AUTO)->quality(100);
					}
					$image->save();
					// миниатюра
					$image = Yii::app()->image->load($path);
					$image->crop(100, 100, TRUE);
					$cropPath = '.'.Yii::app()->getModule('user')->userpicsDir.$name;
					$image->save($cropPath);
					// удаляем прошлый юзерпик и миниатюру
					if( $oldUserpic != Yii::app()->getModule('user')->standartUserpic ) {
						@unlink('.'.Yii::app()->getModule('user')->userpicsDir.$oldUserpic_f);
						@unlink('.'.Yii::app()->getModule('user')->userpicsDir.$oldUserpic);
					}
					Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Изменения успешно сохранены');
					$this->redirect('/account/userpic#crop');
				}
			}
		}
		$this->pageTitle = 'Фотография';
		$this->render('userpic', array('model' => $model));
	}

    /**
     * Удаление юзерпика
     */
	public function actionDeleteUserpic()
	{
		$model = $this->loadModel();

		if( $model->userpic == Yii::app()->getModule('user')->standartUserpic)
		{
			$this->redirect('/account/userpic');
		}

		@unlink('.'.Yii::app()->getModule('user')->userpicsDir.$model->userpic_f);

		@unlink('.'.Yii::app()->getModule('user')->userpicsDir.$model->userpic);

		$model->userpic_f = Yii::app()->getModule('user')->standartUserpic_f;

		$model->userpic = Yii::app()->getModule('user')->standartUserpic;
			
		$model->save();			

		$this->redirect('/account/userpic');
	}


    /**
     * Изменение контактных данных
     */
	public function actionContact()
	{
		$model = $this->loadModel();

		$model->setScenario('contact');

		if( Yii::app()->request->isPostRequest && !empty($_POST['User']) )
		{
			$model->attributes = $_POST['User'];

			if( $model->validate() )
			{
				$model->save();

				Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Изменения успешно сохранены');

				$this->refresh();
			}
		}

		$this->pageTitle = 'Контактные данные';

		$this->render('contact', array('model' => $model));
	}

    /**
     * Портфолио
     */
	public function actionPortfolio()
	{
		Yii::app()->getModule('portfolio');
	
		$model = Portfolio::model()->user();

		$dataProvider = new CActiveDataProvider($model, array(
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'date' => true
				),
				'attributes' => array(
					'date',
					'title'
				)
			),
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => 20,
			),
		));

		$this->pageTitle = 'Портфолио';

		$this->render('portfolio', array('dataProvider' => $dataProvider));
	}

    /**
     * Проекты
     */
	public function actionTenders($status = 'auction')
	{//DebugBreak();
		Yii::app()->getModule('tenders');
        $model = New Tenders();
		$model = $model->user();
		/*if( $status == Tenders::STATUS_OPEN ) {
			$model = $model->opened();
		} elseif( $status == Tenders::STATUS_CLOSE ) {
			$model = $model->closed();
        } elseif( $status == Tenders::STATUS_CLOSE ) {
            $model = $model->closed();
        }*/ 
        
        if( $status == 'auction' ) {
            $criteria = $model->auction()->getDBCriteria();
        } else if( $status == 'closed' ) {
            $criteria = $model->closed()->getDBCriteria();
        } else if ($status == 'arbitration') {
            $criteria = $model->with(array('sbs'=>array('scopes'=>'disputed', 'condition'=>'sbs.status = :status')));
            $criteria = $criteria->getDBCriteria();
        } else {  //если status не задано
            $criteria = $model->auction()->getDBCriteria();
        }

		$dataProvider = new CActiveDataProvider($model, array(
            'criteria'=>$criteria, //$model->getDBCriteria(),
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'date' => true
				),
				'attributes' => array(
					'date',
					'title'
				)
			),
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => 20,
			),
		));
		$this->pageTitle = 'Мои проекты';
		/*$countAll = new Tenders;
		$countAll = $countAll->user()->count();
		$countOpened = new Tenders;
		$countOpened = $countOpened->user()->opened()->count();
		$countClosed = new Tenders;
		$countClosed = $countClosed->user()->closed()->count();*/
        //DebugBreak();
		$this->render('tenders', array(
            'dataProvider' => $dataProvider, //'countAll' => $countAll, 'countOpened' => $countOpened, 'countClosed' => $countClosed
        ));
	}

    /**
     * Заявки
     */
	public function actionBids($status = '')
	{
		Yii::app()->getModule('tenders');
	
		$model = Bids::model()->user();

		if( $status == Bids::STATUS_ACTIVE )
		{
			$model = $model->active();
		}
		elseif( $status == Bids::STATUS_ACCEPT )
		{
			$model = $model->accepted();
		}
		elseif( $status == Bids::STATUS_DECLINE )
		{
			$model = $model->declined();
		}
		elseif( $status == Bids::STATUS_REJECT )
		{
			$model = $model->rejected();
		}

		$dataProvider = new CActiveDataProvider($model, array(
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'date' => true
				),
				'attributes' => array(
					'date',
					'title'
				)
			),
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => 20,
			),
		));

		$this->pageTitle = 'Мои заявки';

		$countAll = new Bids;

		$countAll = $countAll->user()->count();

		$countActive = new Bids;

		$countActive = $countActive->user()->active()->count();

		$countAccepted = new Bids;

		$countAccepted = $countAccepted->user()->accepted()->count();

		$countDeclined = new Bids;

		$countDeclined = $countDeclined->user()->declined()->count();

		$countRejected = new Bids;

		$countRejected = $countRejected->user()->rejected()->count();

		$this->render('bids', array('dataProvider' => $dataProvider, 'countAll' => $countAll, 'countActive' => $countActive, 'countAccepted' => $countAccepted, 'countDeclined' => $countDeclined, 'countRejected' => $countRejected));
	}

    /**
     * История
     */
	public function actionHistory()
	{
		$model = History::model()->user();

		$dataProvider = new CActiveDataProvider($model, array(
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'date' => true
				),
				'attributes' => array(
					'date',
					'amount',
					'descr'
				)
			),
			'pagination'=>array(
				'pageVar' => 'p',
				'pageSize' => 20,
			),
		));

		$this->pageTitle = 'История';

		$this->render('history', array('dataProvider' => $dataProvider));
	}

    /**
     * Кошельки
     */
	public function actionPurses()
	{
		$model = Purses::model()->user();

		$dataProvider = new CActiveDataProvider($model, array(
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'date' => true
				),
				'attributes' => array(
					'date',
					'amount'
				)
			),
			'pagination'=>array(
				'pageVar' => 'p',
				'pageSize' => 20,
			),
		));

		$this->pageTitle = 'Кошельки';

		$this->render('purses', array('dataProvider' => $dataProvider));
	}

    /**
     * Удалить
     */
	function actionDeletepurse($id)
	{
		$model = Purses::model()->findByPk($id);
	
		if( !$model )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}
	
		if( !Yii::app()->user->checkAccess('deleteContact', array('contact' => $model)))
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		$model->delete();

		Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Кошелек успешно удален');

		$this->redirect('/account/purses');
	}

    /**
     * Платежи
     */
	public function actionPayments()
	{
		$model = Payments::model();

		$criteria = new CDbCriteria;

		$criteria->condition = 'user_id = :user_id or recipient_id = :user_id';

		$criteria->params = array(':user_id' => Yii::app()->user->id);

		$dataProvider = new CActiveDataProvider($model, array(
			'criteria' => $criteria,
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'date' => true
				),
				'attributes' => array(
					'date',
					'amount'
				)
			),
			'pagination'=>array(
				'pageVar' => 'p',
				'pageSize' => 20,
			),
		));

		$this->pageTitle = 'Платежи';

		$this->render('payments', array('dataProvider' => $dataProvider));
	}

    /**
     * Купить товар
     */
	public function actionBuy()// статус продукта должен быть открытым и не  принадлежать пользователю
	{
		Yii::app()->getModule('items');
		
		$id = $_POST['id'];

    	$model = Items::model()->findByPk($id);

		$user = $this->loadModel();

    	if( !$model )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		$result = array();

		if( $model->cost > $user->balance )// ошибка
		{
			$result = array(
				'error' => array('msg' => 'Недостаточно средств')
			);
		}

		if( $model->status != Items::STATUS_OPEN )// ошибка
		{
			$result = array(
				'error' => array('msg' => 'Товар должен иметь статус открыт')
			);
		}

		if( ItemsPurchased::model()->findByAttributes(array('user_id' => Yii::app()->user->id, 'item_id' => $id) ) )// ошибка
		{
			$result = array(
				'error' => array('msg' => 'Товар уже куплен')
			);
		}

		if( $result['error'] )
		{
			echo json_encode($result);
			
			Yii::app()->end();
		}

		if( $model->checkFile() )// если загружен файл, + прибавить баланс продавцу
		{
			$transaction = Yii::app()->db->beginTransaction();// начало транзакции

			try
			{
				// создание купленного товара
				$purchased = new ItemsPurchased;
				$purchased->item_id = $model->id;// id товара
				$purchased->product_id = $model->product->id;
				$purchased->save();
		
				new Events_helper($model->user_id, Yii::app()->user->id, Events_helper::BUY_ITEMS);
	
				Balance_helper::change(Yii::app()->user->id, -$model->cost, 'Покупка товара "'.$model->title.'"');// покупатель
	
				Balance_helper::change($model->user_id, $model->cost, 'Ваш товар "'.$model->title.'" был куплен');// продавец

				$transaction->commit();

				Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Товар добавлен');
	
				$url = '/account/purchased';
			}
			catch(Exception $e)
			{
				$transaction->rollback();

				Yii::log("При покупки товара произошла ошибка!", CLogger::LEVEL_ERROR);  

				$result = array(
					'error' => $e->getMessage()
				);
				
				echo json_encode($result);
				
				Yii::app()->end();
			}
		}
		else
		{
			$transaction = Yii::app()->db->beginTransaction();// начало транзакции

			try
			{
				// создание платежа
				$payment = new Payments;
				$payment->item_id = $model->id;// id товара
				$payment->recipient_id = $model->user_id;// получатель - автор продукта
				$payment->amount = $model->cost;// цена товара
	
				$payment->save();

				new Events_helper($model->user_id, Yii::app()->user->id, Events_helper::PAYMENT_ITEMS, $payment->id);

				Balance_helper::change(Yii::app()->user->id, -$model->cost, 'Создан платеж, для товара "'.$model->title.'"');// покупатель

				$transaction->commit();

				Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Платеж создан');
	
				$url = '/account/payments';
			}
			catch(Exception $e)
			{
				$transaction->rollback();

				Yii::log("При создании платежа произошла ошибка!", CLogger::LEVEL_ERROR);  

				$result = array(
					'error' => $e->getMessage()
				);
				
				echo json_encode($result);
				
				Yii::app()->end();
			}
		}

		$result = array(
			'success' => TRUE,
			'url' => $url
		);

		$model->saveCounters(array('sales' => 1));// увеличием число продаж товара

		echo json_encode($result);
	}

    /**
     * Просмотр платежа
     */
	public function actionViewPayment($id = '', $action = '')
	{
    	$model = Payments::model()->findByPk($id);

    	if( !$model )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		if( $action == 'cancel' )
		{
			if( $model->status != Payments::STATUS_ACTIVE or $model->recipient_id != Yii::app()->user->id )
			{
				throw new CHttpException(404, 'The requested page does not exist.');
			}

			$transaction = Yii::app()->db->beginTransaction();// начало транзакции

			try
			{
				$model->status = Payments::STATUS_RETURNED;
				
				$model->save();

				//Events_helper::create($model->user_id, 'Платеж возвращен');
	
				Balance_helper::change($model->user_id, $model->amount, 'Платеж возвращен');// отправитель

				$transaction->commit();

				Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Платеж возвращен');

				$this->redirect('/account/payments/'.$id.'.html');

			}
			catch(Exception $e)
			{
				$transaction->rollback();

				Yii::log("При возвращении платежа произошла ошибка! - ".$e->getMessage()."", CLogger::LEVEL_ERROR);  

				Yii::app()->user->setFlash(FlashMessages::ERROR, $e->getMessage());
			}
		}

		if( $action == 'apply' )
		{
			if( $model->status != Payments::STATUS_ACTIVE or $model->user_id != Yii::app()->user->id  )
			{
				throw new CHttpException(404, 'The requested page does not exist.');
			}

			$transaction = Yii::app()->db->beginTransaction();// начало транзакции

			try
			{	
				$model->status = Payments::STATUS_COMPLETED;
				
				$model->save();

				new Events_helper($model->recipient_id, $model->user_id, Events_helper::COMPLETED_ITEMS);
	
				Balance_helper::change($model->recipient_id, $model->amount, 'Платеж завершен');// получатель

				$transaction->commit();

				Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Платеж завершен');
	
				$this->redirect('/account/payments/'.$id.'.html');
			}
			catch(Exception $e)
			{
				$transaction->rollback();

				Yii::log("При подтврждении платежа произошла ошибка! - ".$e->getMessage()."", CLogger::LEVEL_ERROR);  

				Yii::app()->user->setFlash(FlashMessages::ERROR, $e->getMessage());
			}
		}

		$this->pageTitle = 'Платежи';

		$this->render('viewpayment', array('data' => $model));
	}

    /**
     * добавить кошелек
     */
	public function actionAddPurse()
	{
		$model = new Purses;

		if( Yii::app()->request->isPostRequest && !empty($_POST['Purses']) )
        {				
			$model->setAttributes($_POST['Purses']);       

			if( $model->validate() )
            {
				$model->save();

				Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Кошелек успешно добавлен');

				$this->redirect('/account/purses');
			}
		}

		$this->pageTitle = 'Добавить кошелек';

		$this->render('addpurse', array('model' => $model, 'categories' => $categories));
	}

    /**
     * вывод
     */
	public function actionWithdraw()
	{
		$model = Withdraw::model()->user();
		$dataProvider = new CActiveDataProvider($model, array(
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'date' => true
				),
				'attributes' => array(
					'date',
					'amount'
				)
			),
			'pagination'=>array(
				'pageVar' => 'p',
				'pageSize' => 20,
			),
		));
		$this->pageTitle = 'Вывод средств';
		$this->render('withdraw', array('dataProvider' => $dataProvider));
	}

    /**
     * добавить заявку на вывод
     */
	public function actionAddWithdraw()
	{
		$model = new Withdraw;
		if( Yii::app()->request->isPostRequest && !empty($_POST['Withdraw']) )
        {				
			$model->setAttributes($_POST['Withdraw']);       
			if( $model->validate() ) {
				$transaction = Yii::app()->db->beginTransaction();// начало транзакции 
				try {
					$model->save();// сохраняем вывод
					Balance_helper::change(Yii::app()->user->id, -$model->amount, 'Вывод средств');
					$transaction->commit();
					Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Заявка на вывод добавлена');
					$this->redirect('/account/withdraw');

				} catch(Exception $e) {
					$transaction->rollback();
					Yii::log("При выводе средств произошла ошибка!", CLogger::LEVEL_ERROR);  
					$model->addError('amount', 'При выводе средств произошла ошибка!');
				}
			}
		}
		$purses =  Purses::model()->user()->findAll();
		$this->pageTitle = 'Добавить заявку на вывод';
		$this->render('addwithdraw', array('model' => $model, 'purses' => $purses));
	}

    /**
     * Подписан
     */
	public function actionFavorites()
	{
		$model = UsersFavorites::model()->user();
		$criteria = new CDbCriteria(array(
			'with' => array(
				'favoritedata'
			)
		));
		if( isset($_GET['online']) ) {
			$criteria->addSearchCondition('online', 1);
		}
		$dataProvider = new CActiveDataProvider($model, array(   
			'criteria' => $criteria,
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'date' => true
				),
				'attributes' => array(
					'date',
                    'favoritedata.username',
				)
			),
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => 20,
			),
		));
		$this->pageTitle = 'Подписан';
		$this->render('favorites', array('dataProvider' => $dataProvider));
	}

	public function actionRating()
	{
		$user = $this->loadModel();
		$model = new UsersRating;
		$data = $model->findByPk(Yii::app()->user->id);
		$this->pageTitle = 'Рейтинг';
		$this->render('rating', array('model' => $model, 'user' => $user, 'data' => $data));
	}


    /**
     * Баланс
     */
	public function actionBalance()
	{
		$renderdata = array(
			'purse' => 'R951805365035'
		);
		$this->pageTitle = 'Баланс';
		$this->render('balance', $renderdata);
	}

    /**
     * Аккаунт
     */
	public function actionLoadCrop() 
	{
		$user = $this->loadModel();
		if( $user->userpic != Yii::app()->getModule('user')->standartUserpic ) {
			$this->renderPartial('LoadCrop', array('user' => $user));
		} else {// если у пользователя стандартный юзерпик, то запрещаем редактировать миниатюру
			$this->renderPartial('LoadCropError', array('user' => $user));
		}
	}

    /**
     * Кроппирование юзерпика
     */
	function actionCrop()
	{
		Yii::import('ext.EJCropper');

		$model = $this->loadModel();

		$oldUserpic = $model->userpic;// заменяемый юзерпик

		$userpic = '.'.Yii::app()->getModule('user')->userpicsDir.$model->userpic_f;

		$jcropper = new EJCropper();
		
		$jcropper->thumbPath = '.'.Yii::app()->getModule('user')->userpicsDir;
		 
		$jcropper->jpeg_quality = 100;

		$jcropper->png_compression = 8;
		 
		$coords = $jcropper->getCoordsFromPost('crop');// получаем координаты

		$name = Yii::app()->getModule('user')->userpicPrefix.Randomness::randomString(10);

		$thumbnail = $jcropper->crop($userpic, $coords, $name);
		
		if( $thumbnail )
		{
			// удаляем прошлый юзерпик
			if( $oldUserpic != Yii::app()->getModule('user')->standartUserpic )
			{
				@unlink('.'.Yii::app()->getModule('user')->userpicsDir.$oldUserpic);	
			}

			$model->userpic = $thumbnail;

			if( $model->save() )
			{
				$result = array(
					'success' => TRUE
				);

				echo json_encode($result);
			}
		}
	}


	public function beforeAction($action)
	{
		$this->fullness = new Profile_helper;
		$this->guests = Guests::model()->user()->findAll();
		return TRUE;
	}

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @return User
     */
	public function loadModel()
	{

//        var_dump(Yii::app()->user->isAuthenticated()); exit;
		if( $this->_model === null )
		{

			if( Yii::app()->user->isAuthenticated() )// если пользователь авторизирован
			{
				$this->_model = User::model()->findbyPk(Yii::app()->user->id);

			}
			if( $this->_model === null )
			{
				throw new CHttpException(404, 'The requested page does not exist.');
			}
        }
        return $this->_model;
    }
}