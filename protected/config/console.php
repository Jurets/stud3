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

        //'application.extensions.taggable.*',

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
                /*array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron.log',
                    'levels'=>'error, warning',
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron_trace.log',
                    'levels'=>'trace',
                ),
                array( //оповещение о вебинаре
                    'class'=>'CFileLogRoute',
                    'logFile'=>'webinar_notify.log',
                    'levels'=>'info',
                    'categories'=>'notify.webinar',
                ),
                array( //автоматическая деактивация юзеров, у которых окончился срок активации
                    'class'=>'CFileLogRoute',
                    'logFile'=>'activation_notify.log',
                    'levels'=>'info',
                    'categories'=>'notify.activation',
                ),
                array( //логирование почтовой рассылки
                    'class'=>'CFileLogRoute',
                    'logFile'=>'mail.log',
                    'levels'=>'info, error',
                    'categories'=>'mail',
                ),*/
                array( //принудительное резервирование на вебинар
                    'class'=>'CFileLogRoute',
                    'levels'=>'info',
                    'categories'=>'sbs.autocomplete',
                    'logFile'=>'sbs_autocomplete.log',
                ),
            ),
        ),
        
	),
);