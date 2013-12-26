<?php
class ProfileController extends Controller
{
    /**
     * Фильтры
     */
    public function filters()
    {
        return array(
			array('UserFilter + invite, AddReview'),
			array('UserFilter', 'activation' => true),
        );
    }


    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    public $checkFriend;// в контакт списке?

    public $checkInvite;// отправлено новое приглашение?

    /**
     * Профиль
     */
	public function actionIndex()
	{
		$data = $this->loadModel();

		// портфолио
		Yii::app()->getModule('portfolio');

		$criteria = new CDbCriteria();
		
		$criteria->order = 'date desc';
	
		$criteria->limit = 3;
 
		$portfolio = Portfolio::model()->user($data->id)->findAll($criteria);


		$renderdata = array(
			'data' => $data,
			'favorites' => $favorites,
			'portfolio' => $portfolio,
		);

		$this->pageTitle = $data->username.' | Профиль';

		$this->render('index', $renderdata);
	}

    /**
     * Подписчики
     */
	public function actionFavorites()
	{
		$data = $this->loadModel();

		$model = UsersFavorites::model();

		$criteria = new CDbCriteria(array(
			'condition' => 'favorite = :favorite',
			'params' => array(':favorite' => $data->id),
			'with' => array(
				'userdata:min'
			)
		));

		$dataProvider = new CActiveDataProvider($model, array(   
			'criteria' => $criteria,
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'date' => true
				),
				'attributes' => array(
					'date',
                    'userdata.username',
				)
			),
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => 20,
			),
		));

		$renderdata = array(
			'dataProvider' => $dataProvider,
			'data' => $data
		);

		$this->pageTitle = $data->username.' | Подписчики';

		$this->render('favorites', $renderdata);
	}

    /**
     * Блог
     */
	public function actionBlog()
	{
		$data = $this->loadModel();

		Yii::app()->getModule('blogs');

		$model = Blogs::model()->user($data->id);

		$dataProvider = new CActiveDataProvider($model, array(   
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'date' => true
				),
				'attributes' => array(
					'date',
					'title',
					'like'
				)
			),
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => 20,
			),
		));

		$renderdata = array(
			'dataProvider' => $dataProvider,
			'data' => $data
		);

		$this->pageTitle = $data->username.' | Блог';

		$this->render('blog', $renderdata);
	}

    /**
     * Контакты
     */
	public function actionContacts()
	{
		$data = $this->loadModel();

		Yii::app()->getModule('blogs');

		$model = Friends::model()->with('frienddata')->user($data->id);

		$dataProvider = new CActiveDataProvider($model, array(   
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'date' => true
				),
				'attributes' => array(
					'date',
                    'frienddata.username',
				)
			),
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => 20,
			),
		));

		$renderdata = array(
			'dataProvider' => $dataProvider,
			'data' => $data
		);

		$this->pageTitle = $data->username.' | Контакты';

		$this->render('contacts', $renderdata);
	}

    /**
     * Отзывы
     */
	public function actionReviews($review = '')
	{
		$data = $this->loadModel();

		$model = Reviews::model()->user($data->id);

		if( $review )
		{
			if( $review == 'positive' )
			{
				$model->positive();
			}
			elseif( $review == 'negative' )
			{
				$model->negative();
			}
		}

		$dataProvider = new CActiveDataProvider($model, array(   
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'date' => true
				),
				'attributes' => array(
					'date',
                    'userdata.username',
					'mark'
				)
			),
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => 20,
			),
		));

		$renderdata = array(
			'dataProvider' => $dataProvider,
			'data' => $data
		);

		$this->pageTitle = $data->username.' | Отзывы';

		$this->render('reviews', $renderdata);
	}

    /**
     * Добавить отзыв
     */
	public function actionAddReview()
	{
		$data = $this->loadModel();

		// нельзя оставлять отзыв себе
		if( $data->id == Yii::app()->user->id )
		{	
			Yii::app()->user->setFlash(FlashMessages::ERROR, 'Нельзя оставлять отзыв себе');

			$this->redirect('/users/reviews/'.$data->username);
		}

		$check = Reviews::model()->findByAttributes(array('user_id' => $data->id, 'from_id' => Yii::app()->user->id));
	
		// если отзыв был уже добавлен
		if( $check )
		{
			Yii::app()->user->setFlash(FlashMessages::ERROR, 'Отзыв уже добавлен');

			$this->redirect('/users/reviews/'.$data->username);
		}
		
		$model = new Reviews;

		if( Yii::app()->request->isPostRequest && !empty($_POST['Reviews']) )
        {
			$model->setAttributes($_POST['Reviews']);

			$model->user_id = $data->id;

			if( $model->validate() )
            {
				$model->save();

				Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Отзыв успешно добавлен');

				$this->redirect('/users/reviews/'.$data->username);
			}
		}

		$this->pageTitle = 'Добавить отзыв';

		$this->render('addreview', array('model' => $model));
	}

    /**
     * Портфолио
     */
	public function actionPortfolio()
	{
		Yii::app()->getModule('portfolio');

		$data = $this->loadModel();

		$model = Portfolio::model()->user($data->id);

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

		$renderdata = array(
			'dataProvider' => $dataProvider,
			'data' => $data
		);

		$this->pageTitle = $data->username.' | Портфолио';

		$this->render('portfolio', $renderdata);
	}

    /**
     * Пригласить пользователя
     */
	public function actionInvite()
	{
		$data = $this->loadModel();

		if( $invite = Invitations::model()->new()->findByAttributes(array('sender_id' => $data->id, 'recipient_id' => Yii::app()->user->id)) )
		{
			Yii::app()->user->setFlash(FlashMessages::SUCCESS, ''.$data->name.' уже отправил Вам приглашение, если хотите добавить в контакты примите его.');
			
			$this->redirect('/account/invitations');
		}

		if( $data->id == Yii::app()->user->id )
		{	
			$this->redirect('/users/'.$data->username);
		}

		if( $this->checkFriend )
		{
			Yii::app()->user->setFlash(FlashMessages::SUCCESS, ''.$data->name.' уже находится в контактах');
			
			$this->redirect('/account/contacts');
		}

		if( $this->checkFriend )
		{
			Yii::app()->user->setFlash(FlashMessages::SUCCESS, ''.$data->name.' уже находится в контактах');
			
			$this->redirect('/account/contacts');
		}

		$model = new Invitations;

		if( Yii::app()->request->isPostRequest && !empty($_POST['Invitations']) )
        {
			$model->setAttributes($_POST['Invitations']);

			$model->recipient_id = $data->id;

			if( $model->validate() )
            {
				$model->save();


				new Events_helper($model->recipient_id, $model->sender_id, Events_helper::SENT_INVITE);


				$this->redirect('/account/myinvitations');
			}
		}

		$model->text = 'Здравствуйте, '.$data->name.'.

Прошу добавить меня в свои контакты.';

		$this->pageTitle = 'Отправить приглашение';

		$this->render('invite', array('model' => $model));
	}

    /**
     * Товары
     */
	public function actionItems()
	{
		Yii::app()->getModule('items');

		$data = $this->loadModel();

		$model = Items::model()->user($data->id)->opened();

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

		$renderdata = array(
			'dataProvider' => $dataProvider,
			'data' => $data
		);

		$this->pageTitle = $data->username.' | Товары';

		$this->render('items', $renderdata);
	}

	public function loadModel()
	{
		if( $this->_model === null )
		{
			if( isset($_GET['username']) )
			{
				$this->_model = User::model()->find('username = :username', array(':username' => $_GET['username']));
			}

			if( $this->_model === null )
			{
				throw new CHttpException(404, 'The requested page does not exist.');
			}

			if( $this->_model->role == User::ROLE_ADMIN and !Yii::app()->user->getState('isAdmin') )// если админ
			{
				throw new CHttpException(403, 'Доступ к этой странице запрещен.');
			}

			$this->checkFriend = Friends::Check($this->_model->id);

			$this->checkInvite = Invitations::Check($this->_model->id);

			if( $this->_model->is_banned() )// если забанен закрывам профиль
			{
				$this->render('new', array('message' => $this->_model->banned()));
				
				Yii::app()->end();
			}

			if( !Yii::app()->user->getState('isAdmin') && Yii::app()->user->isAuthenticated() && $this->_model->id != Yii::app()->user->id )
			{
				Guests::model()->add($this->_model->id);
			}
        }

        return $this->_model;
    }
}