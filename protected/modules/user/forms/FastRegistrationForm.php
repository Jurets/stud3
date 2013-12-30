<?php
class FastRegistrationForm extends CFormModel
{
	public $username;
	public $email;
	public $password;
    public $captcha;
    public $id;

	/**
	* правила валидации
	*/
	public function rules()
	{
        $module = Yii::app()->getModule('user');

		return array(
			//array('username', 'form_validation', 'rule' => 'nospecial'),
			array('username, email', 'filter', 'filter' => 'trim'),// очищаем пробелы
			array('email', 'required'),// обязательные поля
//			array('username', 'length', 'max' => 20),// логин пользователя длина
			array('email', 'length', 'max' => 50),// email максимальная длина
			array('email', 'email'), 
			array('username', 'checkUsername'),
//			array('email', 'checkEmail'),
            array('captcha', 'captcha', 'on' => 'insert'),
		);
	}

	/**
	* проверка существования логина
	*/
	public function checkPassword($attribute, $params) {
		if ($this->password != $this->password2) {
			$this->addError('password', 'Пароль» должно соответствовать «Повтор пароля');
		}
	}

	/**
	* проверка существования логина
	*/
	public function checkUsername($attribute, $params) {
		$model = User::model()->find('username = :username', array(':username' => $this->username));
		if ($model) {        
			$this->addError('username', 'Извините, такой логин уже занят.');
		}
	}

	/**
	* проверка существования email
	*/
    public function checkEmail($attribute, $params) {
		$model = User::model()->find('email = :email', array(':email' => $this->email));
		if ($model) {     
			$this->addError('email', 'Извините, такой email уже занят.');
		}
    }

	/**
	* метки
	*/
	public function attributeLabels()
	{
		return array(
			'username' => 'Логин',
			'surname' => 'Фамилия',
			'name' => 'Имя',
			'gender' => 'Пол',
			'password' => 'Пароль',
			'password2' => 'Повтор пароля',
			'captcha' => 'Код подтверждения',
			'agree' => 'Принимаю условия <a href="/pages/agreement.html" target="_blank">пользовательского соглашения</a>',
		);
	}
}