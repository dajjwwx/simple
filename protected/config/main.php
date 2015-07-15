<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('common',dirname(dirname(dirname(dirname(__FILE__)))).'\Common');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'悦珂谷',
		
	'language'=>'zh_cn',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*',
		'application.modules.srbac.controllers.SBaseController',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'blueidea',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'srbac' => array(
					'userclass' => 'User',
					'userid' => 'id',
					'username' => 'username',
					'debug' => true,
					'delimeter'=>"@",
					'pageSize' => 10,
					'superUser' => 'Authority',
					'css' => 'srbac.css',
					'layout' => 'application.views.layouts.main', //'webroot.themes.light.views.layouts.admin',
					'notAuthorizedView' => 'srbac.views.authitem.unauthorized',
					//'alwaysAllowed'=>array(),
					'userActions' => array('show', 'View', 'List'),
					'listBoxNumberOfLines' => 15,
					'imagesPath' => 'srbac.images',
					'imagesPack' => 'tango',
					'iconText' => false,
					'header' => 'srbac.views.authitem.header',
					'footer' => 'srbac.views.authitem.footer',
					'showHeader' => true,
					'showFooter' => true,
					'alwaysAllowedPath' => 'srbac.components',
		),
		'test'=>array(),
		'blog'=>array(),
		'administrator'=>array(
// 				'language'=>'zh_cn',
				
		),
		'books'=>array(
		
		),
		'gaokao'=>array(
		
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'swiftMailer' => array(
				'class' => 'ext.swiftMailer.SwiftMailer',
		),		
		'authManager' => array(
				'class' => 'srbac.components.SDbAuthManager',
				'connectionID' => 'db',
				'itemTable' => 'sb_items',
				'assignmentTable' => 'sb_assignments',
				'itemChildTable' => 'sb_itemchildren',
		),
		
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'urlSuffix' => '.html',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
				'<module:\w+>/<controller:\w+>/<id:\d+>'=>'<module>/<controller>/view',
				'<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
				'<module:\w+>/<controller:\w+>'=>'<module>/<controller>',
				'<module:\w+>'=>'<module>',
			),
		),
		/*
		 'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		*/
		'db'=>array(
				'connectionString' => 'mysql:host=localhost;dbname=simplebase',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => 'blueidea',
				'charset' => 'utf8',
				'tablePrefix'=>'sb_',
				'enableProfiling'=>true,
				'schemaCachingDuration'=>3600,
		),
		'dbLibaray'=>array(
				'class'=> 'CDbConnection',
				'connectionString' => 'mysql:host=localhost;dbname=simplelibaray',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => 'blueidea',
				'charset' => 'utf8',
				'tablePrefix'=>'sl_',
				'enableProfiling'=>true,
				'schemaCachingDuration'=>3600,
		),		
		'dbBlog'=>array(
				'class'=> 'CDbConnection',
				'connectionString' => 'mysql:host=localhost;dbname=simpleblog',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => 'blueidea',
				'charset' => 'utf8',
				'tablePrefix'=>'sbg_',
				'enableProfiling'=>true,
				'schemaCachingDuration'=>3600,
		),
		'dbGaokao'=>array(
				'class'=> 'CDbConnection',
				'connectionString' => 'mysql:host=localhost;dbname=simplegaokao',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => 'blueidea',
				'charset' => 'utf8',
				'tablePrefix'=>'gk_',
				'enableProfiling'=>true,
				'schemaCachingDuration'=>3600,
		),
		'cache'=>array(
				'class'=>'system.caching.CFileCache',
				//			'cacheTableName'=>'ls_cache'
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
		
// 				array(
// 					'class'=>'CWebLogRoute',
// 				),
			
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require_once dirname(__FILE__).'/params.php'
);