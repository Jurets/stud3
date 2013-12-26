<?php

class UserModule extends CWebModule
{
    public $accountActivationSuccess = '/login';

    public $accountActivationFailure = '/registration';

    public $loginSuccess = '/';

    public $registrationSucess = '/login';

    public $loginUrl = '/login';

    public $logoutSuccess = '/';

    public $recoveryUrl = '/recovery';

    public $loginAdminSuccess = '';

    public $notifyEmailFrom;

    public $autoRecoveryPassword = 1;

    public $minPasswordLength = 6;

    public $maxPasswordLength = 20;

    public $emailAccountVerification = 1;

    public $showCaptcha = 0;

    public $minCaptchaLength = 3;

    public $maxCaptchaLength = 6;

    public $documentRoot;

    public $userpicsDir = '/data/userpics/';

    public $logoDir = '/data/logo/';

    public $avatarMaxSize = 10000;

    public $standartUserpic_f = 'standart_f.jpg';

    public $standartUserpic = 'standart.jpg';

    public $userpicPrefix = 'small_';

    public $logoPrefix = 'logo_';

    public $avatarExtensions = array('jpg', 'png', 'gif');

    public static $logCategory = 'application.modules.user';

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'user.models.*',
			'user.components.*',
			'user.filters.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
