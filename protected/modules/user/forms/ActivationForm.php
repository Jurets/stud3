<?php
class ActivationForm extends CFormModel
{
	public $code;

	public function rules()
	{
		return array(
			array('code', 'required'),
			array('code','checkCode')
		);
	}

	public function attributeLabels()
	{
		return array(
			'code' => 'Код активации'
		);
	}

	public function checkCode($attribute, $params)
	{    	
		if(!$this->hasErrors())
		{
			$user = User::model()->find('activation_code = :activation_code', array(':activation_code' => $this->code));

			if( !$user )
			{
				$this->addError('code', 'Неверно указан код');
			}
		}
	}
}