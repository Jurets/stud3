<?php
class Articles extends Model
{
	public $_preview;

	public function tableName()
	{
		return '{{articles}}';
	}

	/**
	* Обновление просмотров
	*/
	public function updateViews()
	{
		if( self::checkView() ) return false;

		Yii::app()->db->createCommand()
			->insert('{{articles_views}}', array('article_id' => $this->id, 'user_id' => Yii::app()->user->id, 'ip' => Yii::app()->request->userHostAddress));

		$this->saveCounters(array('views' => 1));
	}


	/**
	* Проверка на просмотр записи
	*/
	public function checkView()
	{
		return Yii::app()->db->createCommand()
			->select('article_id')
			->from('{{articles_views}}')
			->where('article_id = :id and (user_id = :user_id or ip = :ip)', array(':id' => $this->id, ':user_id' => Yii::app()->user->id, ':ip' => Yii::app()->request->userHostAddress))
			->queryScalar();
	}

	/**
	* Проверка на существование в понравившихся
	*/
	public function checkLike()
	{
		if( !Yii::app()->user->isAuthenticated() )
		{
			return FALSE;
		}

		return Yii::app()->db->createCommand()
			->select('blog_id')
			->from('{{blogs_like}}')
			->where('blog_id = :id and user_id = :user_id', array(':id' => $this->id, ':user_id' => Yii::app()->user->id))
			->queryScalar();
	}

	/**
	* Проверка на существование в избранном
	*/
	public function checkFavorite()
	{
		return Yii::app()->db->createCommand()
			->select('blog_id')
			->from('{{blogs_favorites}}')
			->where('blog_id = :id and user_id = :ip', array(':id' => $this->id, ':ip' => Yii::app()->user->id))
			->queryScalar();
	}

	public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

	protected function beforeSave()
    {
		if( $this->isNewRecord )// если новая запись
		{		
			$this->user_id = Yii::app()->user->id;  

			$this->date = time();

			Static_helper::change(Static_helper::BLOGS);
		}

		$this->setTags($_POST['Tags']);

		// для отображения
		$this->short_text_v = nl2br(htmlspecialchars($this->short_text));

    	$this->text_v = nl2br(($this->text));

		$this->text_v = Yii::app()->decoda->parse($this->text);

		return parent::beforeSave();
    }

    protected function beforeDelete()
	{
		// удаляем тэги
		$this->removeAllTags()->save();

		return parent::beforeDelete();
	}

	function behaviors()
	{	
		return array(
			'tags' => array(
				'class' => 'EARTaggableBehavior',
	
				// Имя таблицы для хранения тегов
				'tagTable' => '{{tags_for_articles}}',

				// Имя модели тега
				'tagModel' => 'Tags',

				'tagBindingTable' => '{{articles_tags}}',

				'modelTableFk' => 'article_id',

				'tagTablePk' => 'id',

				'tagTableName' => 'name',

				'tagBindingTableTagId' => 'tag',

				// Если устанвовлено в null (по умолчанию), то не сохраняется в базе
				'tagTableCount' => 'count',
			)
		);
	}

    public function attributeLabels()
    {
        return array(
			'title' => 'Заголовок',
			'category' => 'Категория',
			'short_text' => 'Анонс',
			'text' => 'Текст',
			'preview' => 'Изображение',
        );
    }

    public function relations()
    {
        return array(
            'userdata' => array(self::BELONGS_TO, 'User', 'user_id'),
            'listcomments' => array(self::HAS_MANY, 'ArticlesComments', 'article_id'),
        );
    }

	public function rules()
	{
		return array(
			array('title, short_text, text', 'required'),

            array('title', 'length', 'max' => 100),

            array('short_text', 'length', 'min' => 10, 'max' => 5000),

            array('text', 'length', 'min' => 10, 'max' => 10000),

			array('title', 'form_validation', 'rule' => 'nospecial'),

			array('preview', 'required', 'on' => 'insert'),

            array('preview', 'file', 'on' => 'insert',
                'types'=> 'jpg, gif, png',
                'maxSize' => 1024 * 1024 * 10, // 10MB                
                'tooLarge' => 'The file was larger than 10MB. Please upload a smaller file.',                
            ),
            array('preview', 'file', 'on' => 'update',
                'allowEmpty' => true,
                'types'=> 'jpg, gif, png',
                'maxSize' => 1024 * 1024 * 10, // 10MB                
                'tooLarge' => 'The file was larger than 10MB. Please upload a smaller file.',                
            ),
		);
	}

    public function CategoryName()
	{
        return BlogsCategories::model()->findByPk($this->category)->name;
    }

	public function scopes()
	{
		return array(
			'favorites' => array(
				'condition' => '`id` IN (SELECT blog_id FROM {{blogs_favorites}} WHERE {{blogs_favorites}}.`user_id` = :user_id)',
				'params'    => array(':user_id' => Yii::app()->user->id)
			),
		);
	}

	/**
	* Список записей с наибольшим количеством комментарий
	* @param $limit количество выводимых записей
	*/
	function getTop($limit = 10)
  	{
		return Yii::app()->db->createCommand()
			->order('COUNT({{articles_comments}}.id) desc')
			->limit($limit)
			->select('{{articles}}.*')
			->group('{{articles}}.id')
			->join('{{articles_comments}}', '{{articles_comments}}.article_id = {{articles}}.id')
			->from('{{articles}}')
			->queryAll();
  	}

	/**
	* Список пользователей с наибольшим количеством добавленных записей
	* @param $limit количество выводимых пользователей
	*/
	function getTopUsers($limit = 10)
  	{
		return Yii::app()->db->createCommand()
			->order('COUNT({{articles}}.id) desc')
			->limit($limit)
			->select('username, userpic, COUNT({{articles}}.id) as count')
			->group('{{users}}.id')
			->join('{{articles}}', '{{articles}}.user_id = {{users}}.id')
			->from('{{users}}')
			->queryAll();
  	}
}