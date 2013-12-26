<?php
class Payments extends Model
{
	const STATUS_ACTIVE = 1;// ожидание
	const STATUS_COMPLETED = 2;// выполнен
	const STATUS_RETURNED = 3;// возвращен

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{payments}}';
	}

    public function getStatusList()
	{
		return array(
			self::STATUS_ACTIVE => 'Ожидает завершения',
			self::STATUS_COMPLETED => 'Завершен',
			self::STATUS_RETURNED => 'Возвращен'
		);
	}

    public function getStatus()
    {
		$data = $this->getStatusList();
		return array_key_exists($this->status, $data) ? $data[$this->status] : 'не найден';
    }

	public function relations()
    {
        return array(
            'userdata' => array(self::BELONGS_TO, 'User', 'user_id'),
            'recipient' => array(self::BELONGS_TO, 'User', 'recipient_id'),
        );
    }

	public function beforeSave()
	{        
		if( $this->isNewRecord )
		{
			$this->user_id = Yii::app()->user->id;  

			$this->date = time();

			$this->status = self::STATUS_ACTIVE;

			Rating_helper::change(Rating_helper::PURCHASED);
		}
        
		return parent::beforeSave();     
	}
}