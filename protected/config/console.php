<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',
	// application components
	'components'=>array(
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
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
		
	),
);