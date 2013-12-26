<?php
class Invitations extends Model
{
	const STATUS_NEW   = 1;// новое приглашение
	const STATUS_ACCEPT = 2;// принятое приглашение
	const STATUS_REJECT  = 3;// отклоненное приглашение

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{invitations}}';
	}

	public function getStatusList()
	{
		return array(
			self::STATUS_NEW    => 'Новый',
			self::STATUS_ACCEPT => 'Принят',
			self::STATUS_REJECT => 'Отлонен'
		);
	}

	public function getStatus()
	{
		$data = $this->getStatusList();

		return array_key_exists($this->status, $data) ? $data[$this->status] : '*неизвестно*';
	}

	public function relations()
	{
		return array(
			'recipientdata' => array(self::BELONGS_TO, 'User', 'recipient_id'),
			'senderdata' => array(self::BELONGS_TO, 'User', 'sender_id'),
		);
	}

	public function scopes()
	{
		return array(
			'my' => array(// мои приглашения
				'condition' => 'sender_id = :sender_id',
				'params'    => array(':sender_id' => Yii::app()->user->id)
			),
			'me' => array(// мне приглашения
				'condition' => 'recipient_id = :recipient_id',
				'params'    => array(':recipient_id' => Yii::app()->user->id)
			),
			'new' => array(
				'condition' => $this->getTableAlias().'.status = :status',
				'params'    => array(':status' => self::STATUS_NEW)
			),
			'accepted' => array(
				'condition' => $this->getTableAlias().'.status = :status',
				'params'    => array(':status' => self::STATUS_ACCEPT)
			),
		);
	}

    public function attributeLabels()
    {
        return array(
			'date' => 'Дата',
			'text' => 'Текст приглашения',
        );
    }

	public function rules()
	{
		return array(
			array('text', 'required')
		);
	}

	public function beforeSave()
	{        
		if( $this->isNewRecord )
		{
			$this->sender_id = Yii::app()->user->id;  

			$this->status = self::STATUS_NEW;

			$this->date = time();
		}
        
		return parent::beforeSave();     
	}

	public function check($recipient_id)
	{
		return Yii::app()->db->createCommand()
			->select('id')
			->from('{{invitations}}')
			->where('sender_id = :sender_id and recipient_id = :recipient_id and status = :status', array(':sender_id' => Yii::app()->user->id, ':recipient_id' => $recipient_id, 'status' => self::STATUS_NEW))
			->queryScalar();
	}
}