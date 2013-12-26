<?php
class Purses extends Model
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{purses}}';
	}

    public function attributeLabels()
    {
        return array(
			'date' => 'Дата',
			'last_operation' => 'Последняя операция',
			'purse' => 'Номер кошелька',
			'amount' => 'Сумма',
        );
    }

	public function rules()
	{
		return array(
			array('purse', 'required'),

			array('purse', 'uniquePurse'), 

            array('purse', 'length', 'max' => 13),

            array('purse', 'match', 'pattern' => "/^([r])+[0-9]{12}$/ix", 'message' => 'Неверный формат поля "{attribute}"'),
		);
	}

	public function uniquePurse($attribute, $params = array())
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

	public function beforeSave()
	{        
		if( $this->isNewRecord )
		{
			$this->user_id = Yii::app()->user->id;  
      
			$this->date = time();
		}
        
		return parent::beforeSave();     
	}
}