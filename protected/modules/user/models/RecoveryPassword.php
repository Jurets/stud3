<?php
class RecoveryPassword extends Model
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{recovery_password}}';
	}

	public function rules()
	{
		return array(
			array('user_id, code', 'required'),
			array('user_id', 'numerical', 'integerOnly' => true),
			array('code', 'length', 'max' => 32, 'min' => 32),
			array('code', 'unique'),
		);
	}

	public function relations()
    {
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'user_id' => 'Пользователь',
			'date' => 'Дата создания',
			'code' => 'Код',
		);
	}

	public function generateRecoveryCode($user_id)
	{
		return md5(time() . $user_id . uniqid());
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