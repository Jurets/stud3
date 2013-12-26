<?php
class Guests extends Model
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{guests}}';
	}

	public function relations()
	{
		return array(
			'guestdata' => array(self::BELONGS_TO, 'User', 'guest')
		);
	}

	public function beforeSave()
	{        
		if( $this->isNewRecord )
		{
			$this->date = time();
		}

		$this->update = time();

		return parent::beforeSave();     
	}

	public function check($user_id)
	{
		if( $model = $this->model()->findByAttributes(array('user_id' => $user_id, 'guest' => Yii::app()->user->id)) )
		{
			return $model;
		}
		
		return FALSE;
	}

	public function add($user_id)
	{
		if( $guest = self::check($user_id) )
		{
			$guest->update();
		}
		else
		{
			$guest = new Guests;
	
			$guest->user_id = $user_id;
	
			$guest->guest = Yii::app()->user->id;
		
			$guest->save();
		}
	}
}