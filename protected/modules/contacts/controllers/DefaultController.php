<?php
class DefaultController extends Controller
{
    /**
     * Фильтры
     */
    public function filters()
    {
        return array(
			array('UserFilter')
        );
    }

    /**
     * Отправить сообщение
     */
	public function actionSend($username = '')
	{
		$userdata = User::model()->find('username = :username', array(':username' => $username));

		if( !$userdata )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		if( $userdata->id === Yii::app()->user->id )
		{
			$this->redirect('/contacts');
		}

		Messages::model()->readingMessages($userdata->id);// читаем сообщения полученные от пользователя


		// отправить сообщение
		$form = new Messages;

		if( Yii::app()->request->isPostRequest && !empty($_POST['Messages']) )
        {
			$form->setAttributes($_POST['Messages']);

			$form->sender_id = Yii::app()->user->id;  

			$form->recipient_id = $userdata->id;

			if( $form->validate() )
            {
				$form->save();

				$attachments = CUploadedFile::getInstancesByName('attachments');
	
				// proceed if the images have been set
				if( isset($attachments) && count($attachments) > 0 )
				{
					// go through each uploaded image
					foreach ($attachments as $attachment => $row)
					{
						$sourcePath = pathinfo($row->name);	
	
						$fileName = md5(time()).'.'.$sourcePath['extension'];

						$path = '.'.Yii::app()->getModule('contacts')->messagesAttachmentsDir.$fileName;
	
						if( $row->saveAs($path) )
						{
							// add it to the main model now
							$attachment_add = new MessagesAttachments();
							$attachment_add->name = $fileName; //it might be $img_add->name for you, filename is just what I chose to call it in my model
							$attachment_add->message_id = $form->id; // this links your picture model to the main model (like your user, or profile model)
							$attachment_add->size = $row->size;

							$attachment_add->save(); // DONE
						}
					}
				}

				new Events_helper($form->recipient_id, $form->sender_id, Events_helper::SENT_MESSAGES);

				$this->refresh();
			}
		}


		// сообщения
		$criteria = new CDbCriteria(array(
			'with' => array(
				'userdata'
			)
		));

		$criteria->condition = '(sender_id = :user_id and recipient_id = :contact) or (sender_id = :contact and recipient_id = :user_id)';

		$criteria->params = array(':user_id' => Yii::app()->user->id, ':contact' => $userdata->id);

		$dataProvider = new CActiveDataProvider($form, array(   
			'criteria' => $criteria,
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

		$contact = Contacts::model()->findByAttributes(array('user_id' => Yii::app()->user->id, 'contact' => $userdata->id));

		$black = $contact->group_id == Groups::GROUP_BLACKLIST;

		if( $userdata->role == User::ROLE_ADMIN )
		{
			$black = TRUE;
		}

		$renderdata = array(
			'model' => $userdata,
			'comment' => $form,
			'contact' => $contact,

			'black' => $black,

			'dataProvider' => $dataProvider
		);

		$this->pageTitle = 'Мои контакты';

		$this->render('send', $renderdata);
	}

    /**
     * Список контактов
     */
	public function actionIndex($group_id = '')
	{
		Yii::app()->getClientScript()->registerScriptFile( Yii::app()->baseUrl.'/files/js/contacts.js' );

		$model = Contacts::model()->user();

		$criteria = new CDbCriteria(array(
			'with' => array(
				'userdata:min'
			)
		));

		if( $group_id )
		{
			$group = Groups::model()->findByPk($group_id);
		
			if( $group && Yii::app()->user->checkAccess('deleteContact', array('contact' => $group)) )// проверяем
			{
				$criteria->condition = 'group_id = :group_id';

				$criteria->params[':group_id'] = $group_id;
			}
			else
			{
				$group = '';
			}
		}


		if( $_GET['message'] === 'new' )
		{
			$criteria->addCondition('`contact` IN (SELECT sender_id FROM {{messages}} WHERE {{messages}}.`recipient_id` = :user_id and `reading` = :reading)');

			$criteria->params[':user_id'] = Yii::app()->user->id;

			$criteria->params[':reading'] = 0;
		}

		$dataProvider = new CActiveDataProvider($model, array(   
			'criteria' => $criteria,
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'last_msg' => true
				),
				'attributes' => array(
					'last_msg',
					'messages',
					'userdata.username'
				)
			),
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => 20,
			),
		));

		$groups = Groups::model()->user()->with('countContacts')->findAll();




		$modelg = new Groups;

		if( Yii::app()->request->isPostRequest && !empty($_POST['Groups']) )
        {				
			$modelg->setAttributes($_POST['Groups']);       

			if( $modelg->validate() )
            {
				$modelg->save();

				Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Группа успеша добавлена');

				$this->redirect('/contacts');
			}
		}

		$renderdata = array(
			'dataProvider' => $dataProvider,
			'groups' => $groups,
			'modelg' => $modelg,
			'group' => $group
		);

		$this->pageTitle = 'Мои контакты';

		$this->render('index', $renderdata);
	}

    /**
     * Перемещение контактов
     */
	public function actionMove()
	{
		if( Yii::app()->request->isPostRequest )
        {
			$model = Contacts::model();
	
			$criteria = new CDbCriteria;

			$contacts = $_POST['contacts'];

			$group_id = $_POST['group_id'];

			if( $contacts )
			{
				$criteria->addInCondition('id', $contacts); 
		
				$model->updateAll(array('group_id' => $group_id), $criteria);
				
				Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Контакты успешно перемещены');
	
				$this->redirect('/contacts/?group_id='.$group_id);
			}
		}

		$this->redirect('/contacts/?group_id='.$group_id);
	}
}