<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Fnetwork.ru',

    'defaultController' => 'main',

	'sourceLanguage'=>'en_US',
	'language'=>'ru',
	'charset'=>'utf-8',

    // ���� ���������� �����������
    'theme' => 'default',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'ext.validators.*',// ���������
		'application.helpers.*',

		'application.models.*',
		'application.components.*',

		'application.components.widgets.*',
		//'application.components.widgets.PollWidget',
		//'application.components.widgets.UserLoginWidget',
		//'application.components.widgets.FlashMessages',

		'application.extensions.taggable.*',// ����

        // ����������� ����� �� �������� ������� 
        'application.modules.user.UserModule',
        'application.modules.user.models.*',
        'application.modules.user.forms.*',
        'application.modules.user.components.*',  
        
        'application.modules.tenders.models.*',
        'application.modules.sbs.models.*',

		'application.extensions.swiftMailer.YiiMailMessage',// YiiMailMessage
		'application.extensions.markitup.EMarkitupWidget',// YiiMailMessage
	),

    // ������������ ������� ����������, ��������� http://www.yiiframework.ru/doc/guide/ru/basics.module
	'modules'=>array(
		'sbs',
		'administrator',
		'tenders',
		'news',
        'pages',
        'articles',
        'contacts',
        'portfolio' => array(
            'class' => 'application.modules.portfolio.PortfolioModule',
		),
        'user' => array(
            'class' => 'application.modules.user.UserModule',
/*
            'autoRecoveryPassword' => true,
            'minPasswordLength' => 3,
            'maxPasswordLength' => 6,
            'emailAccountVerification' => false,
            'showCaptcha' => true,
            'minCaptchaLength' => 3,
            'maxCaptchaLength' => 5,
            'documentRoot' => $_SERVER['DOCUMENT_ROOT'],

            'avatarMaxSize' => 100000,
            'avatarExtensions' => array('jpg', 'png', 'gif'),
            'notifyEmailFrom' => 'aopeykin@yandex.ru'
*/

		),

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'entere',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

	),

	// application components
	'components'=>array(


    'decoda' => array(
        'class' => 'ext.decoda.YiiDecoda',
        'defaults' => true,
    ),

         'mail' => array(
			'class' => 'application.extensions.swiftMailer.YiiMail',
			'transportType' => 'php',
			'viewPath' => 'application.views.mail',
			'logging' => true,
			'dryRun' => false,
         ),

		'authManager'=>array(
    // ����� ������������ ���� �������� �����������
    'class' => 'PhpAuthManager',
    // ���� �� ���������. ���, ��� �� ������, ���������� � ����� � �����.
    'defaultRoles' => array('guest'),
		),

	'image'=>array(
          'class'=>'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver'=>'GD',
            // ImageMagick setup path
           // 'params'=>array('directory'=>'/opt/local/bin'),
        ),


        // ��������� Yii::app()->user, ��������� http://www.yiiframework.ru/doc/guide/ru/topics.auth
        'user' => array(
            'class' => 'application.modules.user.components.WebUser',
            'loginUrl' => '/login',
			//'allowAutoLogin'=>true,
        ),

        // ���������������� urlManager, ��������� http://www.yiiframework.ru/doc/guide/ru/topics.url
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'cacheID' => 'cache',
            'rules' => require('rules.php'), 
        ),

        'request' => array(
            'class' => 'HttpRequest',
            //'hostInfo' => 'free-stud.my',
			'noCsrfValidationRoutes'=>array(
				'^user/default/result.*$',
				'^main/upload.*$',// ��������� EAjaxUpload
				'^blogs/default/editcomment.*$',// ������������� �����������
				'^articles/default/editcomment.*$'// ������������� �����������
			),
            'enableCsrfValidation' => true,
            'csrfTokenName' => 'csrf'
        ),

		'db'=>array(
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=freestud3',
			//'emulatePrepare' => true,
			'username' => 'freestud3',
			'password' => 'freestud3q1',
			'charset' => 'utf8',
			'tablePrefix' => 'ci_',
			//'enableProfiling'=>true,
			'schemaCachingDuration' => 1000
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'/main/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'info',
                    'categories'=>'testmail',
                    'logFile'=>'testmail.log',
                ),
                
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
/*
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),

				array(
					'class'=>'CWebLogRoute',
				),
	
			),
		),
*/
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'site'=>'http://free-stud.ru',
	),
);