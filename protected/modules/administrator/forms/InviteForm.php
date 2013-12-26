<?php
class InviteForm extends CFormModel
{
	public $email;

	public function rules()
	{
		return array(
			array('email', 'required'),
			array('email', 'email'),
			array('email','checkEmail')
		);
	}

	public function checkEmail($attribute, $params)
	{    	
		if(!$this->hasErrors())
		{
			$email = User::model()->find('email = :email', array(':email' => $this->email));

			if( $email )
			{
				$this->addError('email', 'Email '.$this->email.' уже зарегистрирован!');
			}
		}
	}
}