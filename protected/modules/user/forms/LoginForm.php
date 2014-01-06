<?php
class LoginForm extends CFormModel
{
    public $username;
    public $password;
    private $_identity;

    public function rules() 
    {
        return array(
            array('username, password', 'required'), 
            array('password', 'authenticate')
        );
    }
	public function attributeLabels()
	{
		return array(
			'username' => 'Адрес электронной почты',
			'password' => 'Пароль',
		);
	}

	/**
	* Количество оставшихся попыток
	*/
	public function countAttempts()
	{
		User::deleteAuthErr();// удаляем ошибки, у которых истек срок
		$data = User::getAuthErr();
		return User::AUTH_ATTEMPTS - $data['count'];
	}

	/**
	* Дата разблокировки
	*/
	public function unlockDate()
	{
		$data = User::getAuthErr();
		return Date_helper::date_smart($data['date']);
	}

	public function authenticate()
	{
		if( !$this->hasErrors() )
		{
			$this->_identity = new UserIdentity($this->username, $this->password);
			if( $this->countAttempts() < 1 ) {           
				$this->addError('password', 'Учетная запись временно заблокирована. Дата разблокировки: '.$this->unlockDate().'');
			} elseif( !$this->_identity->authenticate() ) {
				if( $this->_identity->getErrorCode() == UserIdentity::ERROR_USER_BANNED ) {
					$this->addError('password', 'Аккаунт блокирован! Причина: '.$this->_identity->getBanned().'');
					return FALSE;
				}
				User::updateAuthErr();
				if( $this->countAttempts() < 1 ) {           
					$this->addError('password', 'Учетная запись временно заблокирована. Дата разблокировки: '.$this->unlockDate().'');
				} else {
					$this->addError('password', 'Логин или пароль введены неверно! У вас осталось '.$this->countAttempts().' попыток');
				}
			} else {          
                Yii::app()->user->login($this->_identity);
			}
        }
    }
}