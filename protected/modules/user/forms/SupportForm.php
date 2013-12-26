<?php
class SupportForm extends CFormModel
{
	public $email;

	public $text;

    public $verifyCode;

    public function rules()
    {
        return array(
			array('email, text, verifyCode', 'required'),// обязательные поля
            array('email', 'email'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'email'  => 'Ваш email',
            'text'  => 'Сообщение',
			'verifyCode' => 'Код подтверждения',
        );
    }
}