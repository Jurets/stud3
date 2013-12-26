<?php
class Messages extends Model
{
    /**
     * @return string the associated database table name
     */
	public function tableName()
	{
		return '{{messages}}';
	}

	public function relations()
    {
        return array(
            'userdata' => array(self::BELONGS_TO, 'User', 'sender_id'),
            'recipientdata' => array(self::BELONGS_TO, 'User', 'recipient_id'),
			'files' => array(self::HAS_MANY, 'MessagesAttachments', 'message_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
			'text' => 'Текст'
        );
    }

	public function rules()
	{
		return array(
			array('text', 'required'),
			array('notification', 'safe')
		);
	}

	public function scopes()
	{
		return array(
			'new' => array(
				'condition' => 'reading = :reading',
				'params'    => array(':reading' => 0)
			),
		);
	}

	public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

	/**
	* прочитать сообщения - добавить дату прочтения
	* @param $contact id контакта
	*/
	public function readingMessages($contact)
    {
		$criteria = new CDbCriteria;
		
		$criteria->condition = 'recipient_id = :user_id and sender_id = :contact';
				
		$criteria->params = array(':user_id' => Yii::app()->user->id, ':contact' => $contact);
			
		$this->model()->updateAll(array('reading' => time()), $criteria);
    }

	protected function beforeSave()
    {
		if( $this->isNewRecord )// если новая запись
		{
			$this->date = time();// дата добавление

			$recipient = Contacts::model()->findByAttributes(array('user_id' => $this->recipient_id, 'contact' => $this->sender_id));
	
			// если нету в контактах
			if( !$recipient )
			{
				$model = new Contacts;// добавляем
	
				$model->user_id = $this->recipient_id;
	
				$model->contact = $this->sender_id;

				$model->save();
			}
			else
			{
				$recipient->update();
			}

			$sender = Contacts::model()->findByAttributes(array('user_id' => $this->sender_id, 'contact' => $this->recipient_id));
	
			// если нету в контактах
			if( !$sender )
			{
				$model = new Contacts;// добавляем
	
				$model->user_id = $this->sender_id;
	
				$model->contact = $this->recipient_id;

				$model->save();
			}
			else
			{
				$sender->update();
			}
		}

		return parent::beforeSave();
	}
}