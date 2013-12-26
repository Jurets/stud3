<?php
class Contacts extends CActiveRecord
{
	public $newmessages;

    /**
     * @return string the associated database table name
     */
	public function tableName()
	{
		return '{{contacts}}';
	}

	public function relations()
    {
        return array(
            'userdata' => array(self::BELONGS_TO, 'User', 'contact')
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

	protected function beforeSave()
    {
		$this->saveCounters(array('messages' => 1));

		$this->last_msg = time();

		return parent::beforeSave();
    }

	public function checkNewMessages()
	{
		return Yii::app()->db->createCommand()
			->select('id')
			->from('{{messages}}')
			->where('sender_id = :sender_id and recipient_id = :recipient_id and reading = :reading', array(':sender_id' => $this->contact, ':recipient_id' => $this->user_id, 'reading' => 0))
			->queryScalar();
	}
}