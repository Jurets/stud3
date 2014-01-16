<?php
class WebUser extends CWebUser
{
	private $_model = null;

	function getRole()
	{
		if( $user = $this->getModel() ) {
			return $user->role;
        }
    }

	function getType()
	{
		if( $user = $this->getModel() ) {
			return $user->type;
        }
    }

	private function getModel()
	{
		if( !$this->isGuest && $this->_model === null ) {
			$this->_model = User::model()->findByPk($this->id, array('select' => 'role, type'));
		}
		return $this->_model;
    }


    public function isAuthenticated()
    {
        if( Yii::app()->user->isGuest )	{        
			return false;
		}
        $authData = $this->getAuthData();
		if( $authData['username'] && $authData['loginTime'] && $authData['id'] ) {
			return true;        
		}
        return false;
    }

	protected function getAuthData()
	{
		return array(
			'username' => Yii::app()->user->getState('username'),
			'loginTime' => Yii::app()->user->getState('loginTime'),
			'id' => (int)Yii::app()->user->getState('id')
		);
	}

    public function isSuperUser()
    {
		if( !$this->isAuthenticated() ) 
            return false;
		$loginAdmTime = Yii::app()->user->getState('loginAdmTime');
		$isAdmin      = Yii::app()->user->getState('isAdmin');
		if( $isAdmin == User::ROLE_ADMIN && $loginAdmTime ) 
            return true;
		return false;
    }
}