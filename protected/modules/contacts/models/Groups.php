<?php
class Groups extends CActiveRecord
{
	const GROUP_STANDART = 0;// группа устанавливаемая по умолчанию
	const GROUP_FAVORITE = 'favorite';// черный список - переписка отключается
	const GROUP_BLACKLIST = 'ignor';// черный список - переписка отключается

    /**
     * @return string the associated database table name
     */
	public function tableName()
	{
		return '{{groups}}';
	}

	public function relations()
    {
        return array(
			'countContacts' => array(self::STAT, 'Contacts', 'group_id', 'condition' => 'user_id = '.Yii::app()->user->id)// количество контактов, в папке, созданной пользователем
        );
    }

	public function scopes()
	{
		return array(
			'user' => array(
				'condition' => 'user_id = :user_id',
				'params'    => array(':user_id' => Yii::app()->user->id)
			),
		);
	}

	public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function attributeLabels()
    {
        return array(
			'name' => 'Название'
        );
    }

	public function rules()
	{
		return array(
			array('name', 'required'), 

			array('name', 'uniqueName'), 

            array('name', 'length', 'max' => 25)
		);
	}

	/**
	* уникальное "имя" у пользователя
	*/
	public function uniqueName($attribute, $params = array())
	{
		if( !$this->hasErrors() )
		{
			$params['criteria'] = array(
				'condition' => 'user_id = :user_id',
				'params' => array(':user_id' => Yii::app()->user->id),
			);

			$validator = CValidator::createValidator('unique', $this, $attribute, $params);

			$validator->validate($this, array($attribute));
		}
	} 

	protected function beforeValidate() 
	{
		$this->name = strip_tags($this->name);

		return parent::beforeValidate();
	}
 
	protected function beforeSave()
    {
		if( $this->isNewRecord )// если новая запись
		{
			$this->user_id = Yii::app()->user->id;
		}

		return parent::beforeSave();
    }  
}