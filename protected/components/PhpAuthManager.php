<?php
class PhpAuthManager extends CPhpAuthManager
{
	public function init()
	{
		// иерархию ролей расположим в файле auth.php в директории data
		if( $this->authFile === null )
		{
			$this->authFile=Yii::getPathOfAlias('application.data.auth').'.php';
		}
 
		parent::init();

		// для гостей у нас и так роль по умолчанию guest.
		if( !Yii::app()->user->isGuest )
		{
			if( !$this->isAssigned(Yii::app()->user->role, Yii::app()->user->id) )
			{
				// связываем роль, заданную в БД с идентификатором пользователя,
				// возвращаемым UserIdentity.getId().
				$this->assign(Yii::app()->user->role, Yii::app()->user->id);
				
				$this->save();
			}
		}
	}
}