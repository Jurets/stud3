<?php
class Withdraw extends Model
{
	const STATUS_ACTIVE     = 1;
	const STATUS_COMPLETED  = 2;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{withdraw}}';
	}

	public function getStatusList()
	{
		return array(
			self::STATUS_ACTIVE    => 'Ожидание',
			self::STATUS_COMPLETED => 'Выполнено',
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
            'userdata' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
			'amount' => 'Сумма',
			'purse' => 'Кошелек',
        );
    }

	public function rules()
	{
		return array(
			array('amount', 'required'),

			array('amount', 'numerical', 'min' => 1),

            array('amount', 'checkBalance'),

			array('purse', 'required'),
		);
	}

    public function checkBalance($attribute, $params)
    {
		$model = User::model()->findbyPk(Yii::app()->user->id);

		if( (int)$this->amount > $model->balance )
		{    
            $this->addError('amount', 'На вашем счету недостаточно средств');
		}
    }

	public function beforeSave()
	{        
		if( $this->isNewRecord )
		{
			$this->user_id = Yii::app()->user->id;  
      
			$this->date = time();

			$this->status = self::STATUS_ACTIVE;
		}
        
		return parent::beforeSave();     
	}
}