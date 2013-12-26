<?php
class Events extends Model
{
	const STATUS_OPEN   = 1;
	const STATUS_CLOSE  = 2;

	// типы событий
	// приглашения
	// блоги
	// удаленная работа
	// каталог товаров
	// личные сообщения
	// сообщества
	const TYPE_INVITE = 1;
	const TYPE_BLOGS = 2;
	const TYPE_PROJECTS = 3;
	const TYPE_ITEMS = 4;
	const TYPE_MESSAGES = 5;
	const TYPE_COMMUNE = 6;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{events}}';
	}

	public function scopes()
	{
		return array(
			'invite' => array(
				'condition' => 'type = :type',
				'params'    => array(':type' => self::TYPE_INVITE)
			),
			'blogs' => array(
				'condition' => 'type = :type',
				'params'    => array(':type' => self::TYPE_BLOGS)
			),
			'projects' => array(
				'condition' => 'type = :type',
				'params'    => array(':type' => self::TYPE_PROJECTS)
			),
			'items' => array(
				'condition' => 'type = :type',
				'params'    => array(':type' => self::TYPE_ITEMS)
			),
			'messages' => array(
				'condition' => 'type = :type',
				'params'    => array(':type' => self::TYPE_MESSAGES)
			),
		);
	}

	public function relations()
	{
		return array(
			'objectdata' => array(self::BELONGS_TO, 'User', 'object')
		);
	}

	public function rules()
	{
		return array(
			array('title, location, link', 'safe')
		);
	}

	public function beforeSave()
	{        
		if( $this->isNewRecord )
		{
			$this->date = time();
		}
        
		return parent::beforeSave();     
	}
}