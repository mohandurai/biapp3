<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [


'comments' => [
            'class' => 'rmrevin\yii\module\Comments\Module',
            'userIdentityClass' => 'app\models\User',
            'useRbac' => false,
        ],

        'admin' => [
            'class' => 'mdm\admin\Module',
	     'layout' => 'left-menu',



	      'controllerMap' => [
                 'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'app\models\User',
                    'idField' => 'id', // id field of model User
                ]
            ],
        ]

    ],


       'components' => [
	 'search' => [
        'class' => 'himiklab\yii2\search\Search',
        'models' => [
            'app\modules\page\models\Page',
        ],
    ],
'authClientCollection' => [
        'class' => 'yii\authclient\Collection',
        'clients' => [
            'google' => [
                'class' => 'yii\authclient\clients\GoogleOpenId'
            ],
            'facebook' => [
                'class' => 'yii\authclient\clients\Facebook',
                'clientId' => '440077652841583',
                'clientSecret' => '18d7d14e5d7ab8937271e5d47e4cc3c2',
            ],

                       'twitter' => [
                                  'class' => 'yii\authclient\clients\Twitter',
                                  'consumerKey' => 'Axt22Fss4bFh0OS1S7d6wwcIf',
                                  'consumerSecret' => '8oG2zvjvTkiccgg1SWp7rLYX85EbriZRNnIslwTeYpy2y1GxEY',
                              ],
                  'linkedin' => [
                  'class' => 'yii\authclient\clients\LinkedIn',
                  'clientId' => '75nob1wsy59rs5',
                  'clientSecret' => 'iJTL8ZJkCMFeQuQm',
             ],
              'google' => [
                  'class' => 'yii\authclient\clients\GoogleOAuth',
                  'clientId' => '258518074579-7ikeltlcfgl02t51ab7kcgpobr5o9t4t.apps.googleusercontent.com',
                  'clientSecret' => 'ITxc5igTz0YhdjDdGWkOrlvp',
             ],
            // etc.
        ],
    ],
         'view' => [
         // 'theme' => [
         //     'pathMap' => [
         //        '@app/views' => '@app/views/'
         //     ],
         // ],
    ],
//      'assetManager' => [
//     'basePath' => '@app/web/custom_asst',
// ],

    'assetManager' => [
    'bundles' => [
        'yii\web\JqueryAsset' => [
            'js'=>[]
        ],
        'yii\bootstrap\BootstrapPluginAsset' => [
            'js'=>[]
        ],
        'yii\bootstrap\BootstrapAsset' => [
            'css' => [],
        ],

    ],

],
        'request' => [
	    'enableCookieValidation' => false,
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
	     'cachePath' => 'web/assets',
        ],

	/*	 'session' => [
            'class' => 'yii\web\Session',
            'cookieParams' => ['httponly' => true, 'lifetime' => 3600 * 4],
            'timeout' => 3600*4,
            'useCookies' => true,
        ], */   /// above code is for session timeout irrespective of inactivity

        'user' => [
            'identityClass' => 'app\models\User',
           // 'enableAutoLogin' => true,
		'authTimeout' => 1800, /// session timeout after 15 min of inactivity
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'serv01.m1990.sgded.com',
                'username' => 'info@biweb.com',
                'password' => 'pass@123',
                'port' => '465',
                'encryption' => 'ssl',

            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
		'authManager'=>
		[
			'class'=>'yii\rbac\DbManager',
			'defaultRoles'=>['guest'],
		],

        'db' => require(__DIR__ . '/db.php'),
        'db2' => require(__DIR__ . '/db2.php'),
         'db3' => require(__DIR__ . '/db3.php'),
        /*
        'db2' => [
              'class' => 'yii\db\Connection',
              'dsn' => 'mysql:host=localhost;dbname=test5',
              'username' => 'root',
              'password' => '1111',
              'charset' => 'utf8',
              'on afterOpen' => function ($event) {
                  $event->sender->createCommand("SET time_zone = '+05:30'")->execute();
              },
          ],
        */
    ],

     'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*', // add or remove allowed actions to this list
	    'webservice/*',
      'bi-menus/*',
      'menu-allocation/*',
      'location-master/*',
      'scheduled-interview/report'

        ]
    ],
    'params' => $params,
];

/* /// To show yii2 info on bottom browser panel
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}
*/
return $config;
