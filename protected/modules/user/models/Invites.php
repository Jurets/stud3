<?php
class Invites extends Model
{
	const STATUS_NEW   = 1;
	const STATUS_CLOSE  = 2;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{invites}}';
	}

	public function scopes()
	{
		return array(
			'opened' => array(
				'condition' => 'status = :status',
				'params'    => array(':status' => Invites::STATUS_NEW)
			),
		);
	}

	public function getNew()
	{
		$code = Randomness::randomString(5);

		Yii::app()->db->createCommand()
			->insert('{{invites}}', array('code' => $code, 'status' => self::STATUS_NEW));

		return $code;
	}

	public function add($user_id, $count = 3)
	{
		for($i = 1; $i <= $count; $i++)
		{
			$code = Randomness::randomString(8);

			Yii::app()->db->createCommand()
				->insert('{{invites}}', array('user_id' => $user_id, 'code' => $code, 'status' => self::STATUS_NEW));
		}
	}

	public function update($code, $user_id)
	{
		Yii::app()->db->createCommand()
			->update('{{invites}}', array('joined' => $user_id, 'status' => self::STATUS_CLOSE), 'code = :code', array(':code' => $code));
			
		self::add($user_id);
	}

	public function getUserInvites($user_id)
  	{
		return Yii::app()->db->createCommand()
			->select('*')
			->from('{{invites}}')
			->where('user_id = :user_id', array(':user_id' => $user_id))
			->queryAll();
  	}
}