<?php
class DefaultController extends Controller
{
    public function filters()
    {
        return array(
			'ajaxOnly + favorite, like, json',// только ajax запросы
            array('UserFilter + publication, delete, bidmanagement, management'),
			array('UserFilter + show', 'activation' => true),// чтобы запретить отправку заявок
        );
    }

    /**
     * Список
     */
	public function actionIndex($type = '', $category = '')
	{
		$model = Tenders::model()->opened();
		$criteria = new CDbCriteria;
		
		$dataProvider = new CActiveDataProvider($model, array( 
			'criteria' => $criteria,
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'date' => true
				),
				'attributes' => array(
					'date',
					'budget'
				)
			),
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => 10,
			),
		));

		$renderdata = array(
			'paidplace' => User::model()->pro()->findAll(),
			'category' => $category,
			'dataProvider' => $dataProvider,
			'search' => $search,
			'type' => $type
		);

		if( $category )
		{
			$this->pageTitle = $category->title;
		}
		else
		{
			$this->pageTitle = 'Заказы';
		}

		$this->render('index', $renderdata);
	}

    /**
     * Просмотр
     */
	public function actionShow($id = '', $type = '') {// DebugBreak();
		if ($type == 'accepted') {
			$type = ':accepted';
		} elseif ($type == 'declined') {
			$type = ':declined';
		} elseif ($type == 'rejected') {
			$type = ':rejected';
		} elseif ($type == 'active') {
			$type = ':active';
		} else {
			$type = '';
		}
    	$model = Tenders::model()->with('bidslist'.$type.'')->findByPk($id);
    	if (!$model) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		if (Yii::app()->user->id == $model->user_id) {
			if( $model->checkNewBids() ) {
				$model->readingBids();// переводим заявки в прочитанные
			}
		}
        
        // если не будет переменной bid то в отображении не выведется форма добавления
		if (Yii::app()->user->id && $model->user_id != Yii::app()->user->id && $model->status == Tenders::STATUS_OPEN) {
			$bid = FALSE;
			if ($_GET['action'] == 'edit') {// если редактировать
				if ($model->checkBid()) {  //проверяем - есть ли заявка на этот проект у текущего юзера
					//если да - выбираем заявку текущего юзера на данный проект
                    $bid = Bids::model()->user()->find('project_id = :project_id', array(':project_id' => $id));
				}
			} else {
				if ($model->checkBid()) {  //проверяем - есть ли заявка на этот проект у текущего юзера
                    //если да - выбираем заявку текущего юзера на данный проект
					$bid = Bids::model()->user()->find('project_id = :project_id', array(':project_id' => $id));
				} else {
                    //иначе создаем новый объект заявки
				    $bid = new Bids;
				}
			}
		}
        
		if (Yii::app()->request->isPostRequest && !empty($_POST['Bids'])) {
			$bid->setAttributes($_POST['Bids']);
			if( $bid->validate() ) {
				if( $bid->isNewRecord ) {
					new Events_helper($model->user_id, $bid->user_id, Events_helper::BID_PROJECTS, $id);
					$model->saveCounters(array('bids' => 1));
				}
				$bid->project_id = $id;
				$bid->save();
				$attachments = CUploadedFile::getInstancesByName('attachments');
				if( isset($attachments) && count($attachments) > 0 ) {
					foreach ($attachments as $attachment => $row)	{
						$sourcePath = pathinfo($row->name);	
						$fileName = md5(time()).'.'.$sourcePath['extension'];
						$path = '.'.Yii::app()->getModule('tenders')->previewAttachmentsDir.$fileName;
						if( $row->saveAs($path) ) {
							$image = Yii::app()->image->load($path);
							// миниатюра
							$thumbnailPath = '.'.Yii::app()->getModule('tenders')->previewAttachmentsDir.'small_'.$fileName;
							$image->resize(100, NULL, Image::AUTO)->quality(100);
							$image->save($thumbnailPath);
							$attachment_add = new TendersPreview();
							$attachment_add->bid_id = $bid->id;
							$attachment_add->preview = 'small_'.$fileName;
							$attachment_add->image = $fileName;
							$attachment_add->save();
						}
					}
				}
				$this->redirect('/tenders/'.$id.'.html');
			}
		}
		$this->pageTitle = $model->title;
    	$this->render('show', array('model' => $model, 'bid' => $bid));
	}

    /**
     * Удалить прикрепленный файл
     */
	function actionDelete($id)
	{
		$model = TendersPreview::model()->findByPk($id);

		if( !$model )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		$bid_id = $model->bid_id;

		$bid = Bids::model()->findByPk($bid_id);

		if( !$bid )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		@unlink('.'.Yii::app()->getModule('tenders')->previewAttachmentsDir.$model->preview);

		@unlink('.'.Yii::app()->getModule('tenders')->previewAttachmentsDir.$model->image);

		// удаляем
		$model->delete();

		$this->redirect('/tenders/'.$bid->project_id.'.html');
	}

    /**
     * Управление статусом заявки
     */
	function actionBidManagement($id, $action)
	{
		$bid = Bids::model()->findByPk($id);

		if( !$bid )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		if( $bid->status != Bids::STATUS_ACTIVE )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		$model = Tenders::model()->findByPk($bid->project_id);

		if( !$model )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		if( $action == 'decline' )// заявка отклонена
		{
			if( !Yii::app()->user->checkAccess('deleteContact', array('contact' => $model)) )
			{
				throw new CHttpException(404, 'The requested page does not exist.');
			}

			new Events_helper($bid->user_id, $model->user_id, Events_helper::DECLINED_PROJECTS, $id);

			$bid->status = Bids::STATUS_DECLINE;
		}
		elseif( $action == 'accept' )// заявка принята
		{
			if( !Yii::app()->user->checkAccess('deleteContact', array('contact' => $model)) )
			{
				throw new CHttpException(404, 'The requested page does not exist.');
			}

			if( $accept = $model->checkABid() )// если уже была принята заявка, то прошлую заявку в статус актив
			{
				$accept->status = Bids::STATUS_ACTIVE;
				
				$accept->save();
			}

			new Events_helper($bid->user_id, $model->user_id, Events_helper::ACCEPTED_PROJECTS, $id);

			$bid->status = Bids::STATUS_ACCEPT;
		}
		elseif( $action == 'reject' )
		{
			if( !Yii::app()->user->checkAccess('deleteContact', array('contact' => $bid)) )
			{
				throw new CHttpException(404, 'The requested page does not exist.');
			}

			$bid->status = Bids::STATUS_REJECT;
		}
		else
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		$bid->update();

		$this->redirect('/tenders/'.$model->id.'.html');
	}

    /**
     * Управление статусом проекта
     */
	function actionManagement($id, $action)
	{
		$model = Tenders::model()->findByPk($id);

		if( !$model )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		if( !Yii::app()->user->checkAccess('deleteContact', array('contact' => $model)) )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		if( $action == 'open' )
		{
			$model->status = Tenders::STATUS_OPEN;
		}
		elseif( $action == 'close' )
		{
			$model->status = Tenders::STATUS_CLOSE;
		}
		else
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		$model->update();

		Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Изменения успешно сохранены');

		$this->redirect('/account/tenders');
	}

	public function actionAddLetter()
	{
		$model = new BidLetters;

		$id = $_POST['id'];
		
		$text = $_POST['text'];

		$bid = Bids::model()->findByPk($id);

		if( $id and $text )
        {
			$model->setAttributes(array(
				'bid_id' => $id,
				'text' => $text
			)); 
      
			if( $model->validate() )
            {
				$model->save();

				$result = array(
					'success' => TRUE,
					'user' => $model->userdata->username,
					'date' => Date_helper::date_smart(time()),
					'text' => htmlspecialchars($text)
				);

				if( Yii::app()->user->id != $bid->tender->user_id )// если сообщение отправляет не автор
				{
					$user_id = $bid->tender->user_id;// автор проекта

					new Events_helper($user_id, $bid->user_id, Events_helper::LETTER_PROJECTS, $bid->project_id);
				}
				else
				{
					$user_id = $bid->user_id;

					new Events_helper($user_id, $bid->tender->user_id, Events_helper::LETTER_PROJECTS, $bid->project_id);
				}

				echo json_encode($result);
			}
		}
	}

    /**
     * Добавить
     */
	public function actionPublication($id = '', $type = '')
	{
		Yii::app()->getClientScript()->registerScriptFile( $assetUrl.'/files/js/tenders.js' );

		Yii::app()->getClientScript()->registerCssFile( $assetUrl.'/files/daterangepicker/daterangepicker.css' );

		Yii::app()->getClientScript()->registerScriptFile( $assetUrl.'/files/daterangepicker/date.js' );

		Yii::app()->getClientScript()->registerScriptFile( $assetUrl.'/files/daterangepicker/daterangepicker.js' );

		if( Yii::app()->request->isPostRequest && !empty($_POST['Tenders']) )
        {

			$model->setAttributes($_POST['Tenders']);       

			$validate = $model->validate();

				if( !Yii::app()->user->isAuthenticated() )
				{
					$rmodel->setAttributes($_POST['FastRegistrationForm']);  

					$validate = $rmodel->validate() && $validate;
		 		}
				

			if( $validate )
            {
				if( !Yii::app()->user->isAuthenticated() )
				{
					$model->status = Tenders::STATUS_MODERATION;
					$this->createUser($rmodel);
				}
				else
				{
					$model->status = Tenders::STATUS_OPEN;
				}

				if( $model->save() )
				{
					$this->redirect('/');
				}
	
			}
		}

		$this->pageTitle = 'Опубликовать проект';

		$this->render('publication', array('model' => $model, 'categories' => $categories, 'model' => $model, 'rmodel' => $rmodel));
	}
    
    public function actionAddSpecialities() {DebugBreak();
        $root = new TendersSpeciality;
        $root->name = 'Дошкольное образование';
        $root->saveNode();
        //$root = TendersSpeciality::model()->findByPk(0);
        
        $node = new TendersSpeciality;
        $node->name = 'Воспитатель детского сада';
        $node->appendTo($root);
        $node = new TendersSpeciality;
        $node->name = 'Няня';
        $node->appendTo($root);
        $node = new TendersSpeciality;
        $node->name = 'Логопед';
        $node->appendTo($root);
        $node = new TendersSpeciality;
        $node->name = 'Преподаватель курсов (подготовка к школе)';
        $node->appendTo($root);
        
        $node2 = new TendersSpeciality;
        $node2->name = 'Ищу работу';
        $node2->appendTo($node);
        $node2 = new TendersSpeciality;
        $node2->name = 'Ищу подработку';
        $node2->appendTo($node);
        $node2 = new TendersSpeciality;
        $node2->name = 'Не ищу работу';
        $node2->appendTo($node);
                
        /*$root = new TendersSpeciality;
        $root->title = 'Начальное образование';
        $root->saveNode();*/
    }
}