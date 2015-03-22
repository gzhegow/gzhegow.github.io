<?php

require_once(ROOT_DIR . DS . 'app' . DS . 'helpers' . DS . 'helpers.php');
require_once(ROOT_DIR . DS . 'configs' . DS . 'db.php');
require_once(ROOT_DIR . DS . 'configs' . DS . 'routes.php');

return array(
	'basePath' => ROOT_DIR . DS . 'app',
	'name' => 'Application',
	'defaultController' => 'main',
  'language' => 'ru',
  'sourceLanguage' => 'en',

  'params' => array(
    'adminEmail' => 'gzhegow@gmail.com',
    'hashing' => 'sha1',
    'salt1' => 'gzhe',
    'salt2' => 'gow',
  ),

	// preloading 'log' component
	'preload' => array('log'),

	// autoloading model and component classes
	'import' => array(
		'application.models.base.*',
    'application.models.*',
		'application.components.*'
	),

  'modules' => array(
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => 'qweasdzxc',
			'ipFilters' => false
		),
	),

	// application components
	'components' => array(
    'user'=>array(
      'class' => 'MyWebUser',
      'allowAutoLogin' => true,
      'loginUrl' => '/',
      'guestName' => 'guest'
    ),
    'mailer' => array(
      'class' => 'application.extensions.mailer.EMailer'
    ),
    // 'errorHandler' => array(
      // 'errorAction' => '',
    // ),
		'urlManager' => $routes_cfg,
		'db' => $db_cfg,
    'log' => array(
      'class' => 'CLogRouter',
      'routes' => array(
        array(
          'class' => 'CFileLogRoute',
          'levels' => 'error, warning',
          'enabled' => true,
          'logFile' => 'errors.log',
          'maxFileSize' => '1024',
          'logPath' => 'logs'
        ),
        array(
          'class' => 'CFileLogRoute',
          'levels' => 'trace, info, profile',
          'enabled' => true,
          'logFile' => 'app.log',
          'maxFileSize' => '1024',
          'logPath' => 'logs'
        ),
        array(
          'class' => 'CFileLogRoute',
          'levels' => 'trace, log',
          'enabled' => true,
          'categories' => 'system.db.CDbCommand',
          'logFile' => 'db.log',
          'maxFileSize' => '1024',
          'logPath' => 'logs'
        ),
      ),
    ),
		'session' => array(
      'class' => 'MyCDbHttpSession',
      'connectionID' => 'db',
      'autoCreateSessionTable' => true,
      'sessionTableName' => 'sessions',
      'compareIpAddress' => true,
      'compareUserAgent' => true,
      'compareIpBlocks' => 0
    )
	)
);