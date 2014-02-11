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
            'rules' => array(
                '/commune/<id:\d+>' => 'commune/default/show',
                '/commune/blog/<id:\d+>' => 'commune/blog/',
                '/commune/create' => 'commune/default/create',
                '/commune/blog/publication/<id:\d+>' => '/commune/blog/publication',
                '/commune/blog/delete/<id:\d+>' => '/commune/blog/delete',

                //'/sbs/reserve' => 'sbs/default/reserve',
                //'/sbs/publication' => 'sbs/default/publication',
                '/sbs/arbitration' => 'sbs/default/arbitration',
                '/sbs/complete' => 'sbs/default/complete',
                '/sbs/close' => 'sbs/default/close',
                
                '/sbs/<id:\d+>' => 'sbs/default/show/',
                '/sbs/publication/<id:\d+>' => 'sbs/default/publication/',
                '/sbs/reserve/<id:\d+>' => 'sbs/default/reserve/',
                '/sbs/done/<id:\d+>' => 'sbs/default/done/',
                '/sbs/sendwork/<id:\d+>' => 'sbs/default/sendwork/',

                '/articles/<id:\d+>.html' => 'articles/default/show/',
                '/articles/publication' => 'articles/default/publication',
                '/articles/publication/<id:\d+>' => 'articles/default/publication',
                '/articles/delete/<id:\d+>' => 'articles/default/delete',

				'/search' => 'search/index',
                '/help/<id:\d+>.html' => 'help/default/index/',

                '/tenders/bidmanagement' => 'tenders/default/bidmanagement',
                '/tenders/management' => 'tenders/default/management',
                '/tenders/publication' => 'tenders/default/publication',
                '/tenders/<id:\d+>.html' => 'tenders/default/show/',
                '/news/<id:\d+>.html' => 'news/default/show/',

                '/items/bugtracker/<id:\d+>' => 'items/bugtracker/index/',
                '/items/bugtracker/add/<id:\d+>' => 'items/bugtracker/add/',

                '/blogs/publication' => 'blogs/default/publication',
                '/blogs/publication/<id:\d+>' => 'blogs/default/publication',
                '/blogs/delete/<id:\d+>' => 'blogs/default/delete',
                '/blogs/<id:\d+>.html' => 'blogs/default/show/',

                '/blogs/<_a:(my|new|favorites)>' => 'blogs/default/index/section/<_a>',

                '/items/delete' => 'items/default/delete',
                '/items/management' => 'items/default/management',
                '/items/publication' => 'items/default/publication',
                '/items/script' => 'items/default/script',
                '/items/<id:\d+>.html' => 'items/default/show/',
                '/items/demo/<id:\d+>' => 'items/default/demo/',
                '/pages/<name:>.html' => 'pages/default/show/',

                '/contacts/add' => 'contacts/default/add',

                '/contacts/AddGroup' => 'contacts/default/AddGroup',

                '/contacts/send/<username:>' => 'contacts/default/send/<_a>',

                '/portfolio/delete' => 'portfolio/default/delete',
                '/portfolio/publication' => 'portfolio/default/publication',


                '/user/recoveryPassword' => 'user/default/recoveryPassword',

                '/users' => 'user/default',

                '/account' => 'user/account',

                '/account/<_a:(purchased|favorites|skills|resume|notify|guests|items|myinvitations|invitations|contacts|notice|logo|tenders|bids|payments|portfolio|tariff|services|balance|withdraw|addwithdraw|history|purses|addpurse|deletepurse|events|event|rating|index|userpic|profile|contact|changepassword|blogs)>' => 'user/account/<_a>',
                '/account/payments/<id:\d+>.html' => 'user/account/viewpayment',
                
                '/account/tenders/<status>' => 'user/account/tenders',

                '/users/<username:>' => 'user/profile/index/<_a>',

                '/users/<_a:(favorites|contacts|index|invite|items|blog|portfolio|reviews|addreview)>/<username:>' => 'user/profile/<_a>',


                '/registration/invite' => 'user/default/registrationinvite',

                '/login' => 'user/default/login',
                '/logout' => 'user/default/logout',
                '/registration' => 'user/default/registration',
                '/registration2' => 'user/default/registration2',
                '/recovery' => 'user/default/recovery',
                '/support' => 'user/default/support',
                '/activation' => 'user/default/activation',
                '/confirmation' => 'user/default/confirmation',
				'/activated/id/<user_id:\d+>' => 'user/default/activated',

				
                '/administrator/<module:(pages|sbs|users|tenders|sbs|items|messages|withdraw|news)>/<action:>' => 'administrator/default/list/',

                '/administrator/<module:(pages|sbs|users|tenders|sbs|items|messages|withdraw|news)>' => 'administrator/default/list/',

            ),
        ),

        'request' => array(
            'class' => 'HttpRequest',
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