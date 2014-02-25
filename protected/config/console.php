<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Free-Stud Console Application',
    
    'preload'=>array('log'),
    
    /*'modules'=>array(
        'sbs',
    ),*/
    
    'import'=>array(
        'ext.validators.*',
        'application.helpers.*',

        'application.models.*',
        'application.components.*',

        'application.extensions.taggable.*',

        'application.modules.user.UserModule',
        'application.modules.user.models.*',
        'application.modules.user.forms.*',
        'application.modules.user.components.*',  
        
        'application.modules.tenders.models.*',
        'application.modules.sbs.models.*',

        'application.extensions.swiftMailer.YiiMailMessage',// YiiMailMessage
        'application.extensions.markitup.EMarkitupWidget',// YiiMailMessage
    ),
        
	// application components
	'components'=>array(
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
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
		
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array( //принудительное резервирование на вебинар
                    'class'=>'CFileLogRoute',
                    'levels'=>'info',
                    'categories'=>'sbs.autocomplete',
                    'logFile'=>'sbs_autocomplete.log',
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'info',
                    'categories'=>'testmail',
                    'logFile'=>'testmail.log',
                ),
            ),
        ),

         'mail' => array(
            'class' => 'application.extensions.swiftMailer.YiiMail',
            'transportType' => 'php',
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false,
         ),

        'request' => array(
            'class' => 'HttpRequest',
            'hostInfo' => 'free-stud.my',
            'baseUrl' => '',
            'scriptUrl' => '',
        ),
          
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'cacheID' => 'cache',
            'rules' => require('rules.php'),
        )
          
	),
);