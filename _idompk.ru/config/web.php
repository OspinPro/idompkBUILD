<?php

  $params = require(__DIR__ . '/params.php');

  $config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'timeZone' => 'Europe/Moscow',
    'modules' => [
      'access' => [
        'class' => 'app\modules\access\access',
        'layout' => 'main',
      ],
      'catalog' => [
        'class' => 'app\modules\catalog\catalog',
      ],
        'YandexMarketYml' => [
            'class' => 'corpsepk\yml\YandexMarketYml',
            'cacheExpire' => 86400, // 1 second. Default is 24 hours
            'categoryModel' => 'app\models\FilterItem',
            'shopOptions' => [
                'name' => 'iDomPK –  готовые проекты частных домов',
                'company' => 'iDomPK',
                'url' => 'https://idompk.ru/',
                'currencies' => [
                    [
                        'id' => 'RUR',
                        'rate' => 1
                    ]
                ],
            ],
            'offerModels' => [
                ['class' => 'app\models\Projects'],
            ],
        ],
    ],
    'components' => [
      'i18n' => [
        'translations' => [
          'app*' => [
            'class' => 'yii\i18n\PhpMessageSource',
            //'basePath' => '@app/messages',
            'sourceLanguage' => 'ru-RU',
            'fileMap' => [
              'app' => 'app.php',
              'app/error' => 'error.php',
            ],
          ],
        ],
      ],
      'formatter' => [
        'class' => 'yii\i18n\Formatter',
        'nullDisplay' => '&nbsp;',
        'defaultTimeZone' => 'Europe/Moscow',
        'thousandSeparator' => ' ',
      ],
      'assetManager' => [
        'appendTimestamp' => true,
      ],
      'request' => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'cookieValidationKey' => 'customkey',
        // 'class' => 'app\components\LangRequest'
      ],
      'cache' => [
        'class' => 'yii\caching\FileCache',
      ],

      'user' => [
        'identityClass' => 'app\models\User',
        'enableAutoLogin' => true,
      ],
      'errorHandler' => [
        'errorAction' => 'site/error',
      ],
      'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules'=>[
            'ym.yml' => 'YandexMarketYml/default/index',
        //['pattern' => 'yandex-market', 'route' => 'YandexMarketYml/default/index', 'suffix' => '.yml'],
          'sitemap.xml' => 'site/map',
          [
            'class' => 'app\components\SefRule',
            'connectionID' => 'db',
          ],
          '<controller:(buy|order|site-pages|baza-znanij)>/<name:[a-zA-Z0-9_\-]+>' => '<controller>/item',
          '<module:catalog>/<controller:(proekty-domov)>/<name:[a-zA-Z0-9_\-]+>' => '<module>/<controller>/item',
          '/' => 'site/index',
          'kalkulyator-stroitelstva-doma' => 'calc/index',
        ],
      ],
      'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        // send all mails to a file by default. You have to set
        // 'useFileTransport' to false and configure a transport
        // for the mailer to send real emails.
        'useFileTransport' => false,
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
      'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
  ];

  if (YII_DEBUG) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
      'class' => 'yii\debug\Module',
      'allowedIPs' => ['85.21.233.34', '::1']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
      'class' => 'yii\gii\Module',
      'allowedIPs' => ['85.21.233.34', '::1']
    ];
  }

  return $config;
