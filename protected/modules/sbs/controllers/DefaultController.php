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
    	$model = Sbs::model()->my()->findByPk($id);
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
    	$model = Sbs::model()->findByPk($id);
		$user = $this->loadModel();
    	if( !$model ) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		if( $model->customer_id != Yii::app()->user->id ) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
    	if( $model->status != Sbs::STATUS_NEW ) { // только новые сделки
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
					$this->redirect('/sbs');
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
		if( $id ) { // проект
	    	$tender = Tenders::model()->with('bidslist')->findByPk($id);
			if( !$tender ) {
				throw new CHttpException(404, 'The requested page does not exist.');
			}
			if( !Yii::app()->user->checkAccess('deleteContact', array('contact' => $tender)) ) {
				throw new CHttpException(404, 'The requested page does not exist.');
			}
		} else  {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		$model = new Sbs;
		if( Yii::app()->request->isPostRequest && !empty($_POST['Sbs']) ) {				
			$model->setAttributes($_POST['Sbs']);       
			if( $model->validate() ) {
				$model->project_id = $id;
				$model->save();
				$this->redirect('/sbs');
			}
		}
		$this->pageTitle = 'Новая сделка';
		$this->render('publication', array('model' => $model, 'tender' => $tender));
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