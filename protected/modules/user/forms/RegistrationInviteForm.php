<?php
class RegistrationInviteForm extends CFormModel
{
	public $invitecode;

	public $username;

	public $email;

	public $password;

	public $password2;

	public $country;

	public $city;

	public $name;

	public $surname;

	public $gender;

	public $agree;

    public $verifyCode;

	/**
	* правила валидации
	*/
	public function rules()
	{
        $module = Yii::app()->getModule('user');

		return array(
			array('username', 'form_validation', 'rule' => 'alpha_numeric'),

			array('username, email', 'filter', 'filter' => 'trim'),// очищаем пробелы

			array('invitecode, username, password, password2, email, name, surname, gender', 'required'),// обязательные поля

			array('agree', 'required', 'message' => 'Необходимо принять пользовательское соглашение.'),

			array('username', 'length', 'min' => 3, 'max' => 15),// логин пользователя длина

			array('password, password2', 'length', 'min' => $module->minPasswordLength, 'max' => $module->maxPasswordLength),// пароль длина

			array('email', 'length', 'max' => 50),// email максимальная длина

			array('name, surname', 'length', 'max' => 20),// фамилия, имя максимальная длина

			array('name, surname', 'match', 'pattern' => '/^[A-Za-zА-Яа-яs,]+$/u', 'message' => 'Неверный формат поля "{attribute}" допустимы только символы кириллицы и латиницы'),

			array('email', 'email'), 

			array('username', 'checkUsername'),

			array('email', 'checkEmail'),

			array('verifyCode', 'captcha', 'allowEmpty' => !$module->showCaptcha),    

			array('password, password2', 'checkPassword'),

			array('invitecode', 'checkInvite'),
		);
	}

	/**
	* проверка существования логина
	*/
	public function checkPassword($attribute, $params)
	{
		if( $this->password != $this->password2 )
		{
			$this->addError('password', 'Пароль» должно соответствовать «Повтор пароля');
		}
	}

	/**
	* проверка существования логина
	*/
	public function checkInvite($attribute, $params)
	{
		$model = Invites::model()->opened()->findByPk($this->invitecode);

		if( !$model )
		{        
			$this->addError('invitecode', 'Введённое значение не найдено в нашей базе.');
		}
	}
	
	/**
	* проверка существования логина
	*/
	public function checkUsername($attribute, $params)
	{
		$model = User::model()->find('username = :username', array(':username' => $this->username));

		if( $model )
		{        
			$this->addError('username', 'Извините, такой логин уже занят.');
		}
	}

	/**
	* проверка существования email
	*/
    public function checkEmail($attribute, $params)
    {
		$model = User::model()->find('email = :email', array(':email' => $this->email));

		if( $model )
		{     
			$this->addError('email', 'Извините, такой email уже занят.');
		}
    }

	/**
	* метки
	*/
	public function attributeLabels()
	{
		return array(
			'invitecode' => 'Код приглашения',
			'username' => 'Логин',
			'surname' => 'Фамилия',
			'name' => 'Имя',
			'gender' => 'Пол',
			'password' => 'Пароль',
			'password2' => 'Повтор пароля',
			'verifyCode' => 'Код подтверждения',
			'agree' => 'Принимаю условия <a href="/pages/agreement.html" target="_blank">пользовательского соглашения</a>',
		);
	}
}