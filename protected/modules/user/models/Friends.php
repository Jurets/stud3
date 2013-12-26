<?php
class Friends extends Model
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{friends}}';
	}

	public function relations()
	{
		return array(
			'frienddata' => array(self::BELONGS_TO, 'User', 'friend_id')
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

	public function check($friend_id)
	{
		return Yii::app()->db->createCommand()
			->select('id')
			->from('{{friends}}')
			->where('user_id = :user_id and friend_id = :friend_id', array(':user_id' => Yii::app()->user->id, ':friend_id' => $friend_id))
			->queryScalar();
	}

	public function getBySpecialization($specialization)
  	{
		return Yii::app()->db->createCommand()
			->select('{{friends}}.friend_id')
			->join('{{users}}', '{{users}}.id = {{friends}}.friend_id')
			->from('{{friends}}')
			->where('user_id = :user_id and specialization = :specialization', array(':user_id' => Yii::app()->user->id, ':specialization' => $specialization))
			->queryAll();
  	}
}