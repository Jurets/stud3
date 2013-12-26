<?php
class DefaultController extends BackController
{
	public $model;

	public $user;

	public $action;

	public $view;

	public function init()
	{
		parent::init();

		$this->user = User::model()->findByPk(Yii::app()->user->id);
	}

	protected function setModel()
	{
		switch($this->action)
		{
			case 'pages':
				$title = 'Страницы';
				Yii::app()->getModule('pages');
				$this->model = new Pages;
				$this->view = array('list' => 'pages', 'add' => 'pages-publication');
				break;
			case 'news':
				$title = 'Новости';
				Yii::app()->getModule('news');
				$this->model = new News;
				$this->view = array('list' => 'news', 'add' => 'news-publication');
				break;
			case 'users':
				$title = 'Пользователи';
				Yii::app()->getModule('user');
				$this->model = new User;
				$this->view = array('list' => 'users', 'add' => 'users-publication');
				break;
			case 'items':
				$title = 'Товары';
				Yii::app()->getModule('items');
				$this->model = new Items;
				$this->pageTitle = 'Товары';
				$this->view = array('list' => 'items', 'add' => 'items-publication');
				break;
			case 'tenders':
				$title = 'Проекты';
				Yii::app()->getModule('tenders');
				$this->model = new Tenders;
				$this->view = array('list' => 'tenders', 'add' => 'tenders-publication');
				break;
			case 'sbs':
				$title = 'Безопасная сделка';
				Yii::app()->getModule('sbs');
				Yii::app()->getModule('tenders');
				$this->model = new Sbs;
				$this->view = array('list' => 'sbs', 'add' => 'sbs-publication');
				break;
			case 'withdraw':
				$title = 'Заявки на вывод';
				$this->model = new Withdraw;
				$this->view = array('list' => 'withdraw');
				break;
			case 'messages':
				$title = 'Сообщения';
				Yii::app()->getModule('contacts');
				$this->model = new Messages;
				$this->view = array('list' => 'messages', 'add' => 'items-publication');
				break;
		}

		$this->pageTitle = $title;
	}

    /**
     * Просмотр
     */
	public function actionIndex()
	{
		$this->pageTitle = 'Система управления';

		$this->render('index');
	}

	public function actionArbitration($id = '')
	{
		Yii::app()->getModule('sbs');

    	$model = Sbs::model()->findByPk($id);


		$comment = new SbsLetters;

		if( Yii::app()->request->isPostRequest )
        {
			$comment->setAttributes(array(
				'sbs_id' => $id,
				'text' => $_POST['SbsLetters']['text']
			)); 
      
			if( $comment->validate() )// +отправить письмо автору блога, если комментарий добавлен другим пользователем
            {
				$comment->save();

				Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Комментарий добавлен');

				$this->redirect('/administrator/default/arbitration/?id='.$id);                   
			}
		}


		$this->render('arbitration', array('model' => $model, 'arbitration' => $arbitration, 'comment' => $comment));
	}

	public function actionList($module = '', $action = '')
	{
		$this->pageTitle = 'Система управления';

		$this->action = $module;
		
		$this->setModel();

		if( $_GET['id'] && $action == 'delete' )
		{
			$model = $this->model->findByPk($_GET['id']);

			$model->delete();
			
			$this->redirect('/administrator/'.$this->action);
		}

		if( $_GET['id'] && $action == 'close' )
		{
			$model = $this->model->findByPk($_GET['id']);

			$model->status = 2;

			$model->update();
			
			$this->redirect('/administrator/'.$this->action);
		}

		if( $_GET['id'] && $action == 'open' )
		{
			$model = $this->model->findByPk($_GET['id']);

			$model->status = 1;

			$model->update();
			
			$this->redirect('/administrator/'.$this->action);
		}

		if(  $action == 'add' or $action == 'edit' )
		{
			if( $_GET['id'] )
			{
				$model = $this->model->findByPk($_GET['id']);

				if( !$model )
				{
					$model = $this->model;
				}
			}
			else
			{
				$model = $this->model;
			}

			if( Yii::app()->request->isPostRequest && !empty($_POST[ucfirst($this->action)]) )
			{
				$model->setAttributes($_POST[ucfirst($this->action)]);       
	
				if( $model->validate() )
				{
					$model->save();
	
					$this->redirect('/administrator/'.$this->action);
				}
			}

			$this->render($this->view['add'], array('model' => $model));
		}
		else
		{
			$criteria = new CDbCriteria;

			$count = $this->model->count($criteria);
	

			$pagination = new CPagination($count);
			$pagination->pageSize = 20;
			$pagination->applyLimit($criteria);

	
			$list = $this->model->findAll($criteria);

			$this->render($this->view['list'], array('list' => $list, 'pagination' => $pagination));
		}
	}
}