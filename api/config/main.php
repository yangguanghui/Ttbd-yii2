<?php
$params = array_merge(require (__DIR__ . '/../../common/config/params.php'), require (__DIR__ . '/../../common/config/params-local.php'), require (__DIR__ . '/params.php'), require (__DIR__ . '/params-local.php'));

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => [
        'log'
    ],
    'modules' => [
        'v1' => [
            'class' => 'api\modules\v1\Module'
        ],
        'v2' => [
            'class' => 'api\modules\v2\Module'
        ]
    ],
    'components' => [
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->data !== null && $response->format == "json") {
                    $data = $response->data;
                    if ($response->getIsOK()) {
                        $response->data = [
                            'code' => 1,
                            'msg' => '操作成功',
                            'data' => $data
                        ];
                    }
                }
            }
        ],
        'request' => [
            'csrfParam' => '_csrf-api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser'
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity-api',
                'httpOnly' => true
            ]
        ],
        'session' => [
            // this is the name of the session cookie used for login on the api
            'name' => 'advanced-api'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => [
                        'error',
                        'warning'
                    ]
                ]
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'default/error'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true, // 启用美化URL
            'enableStrictParsing' => false, // 是否执行严格的url解析
            'showScriptName' => false, // 在URL路径中是否显示脚本入口文件
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'user',
                        'v1/user',
                        'v2/user',
                        'v1/version',
                        'v1/banner',
                        'v1/news',
                    ]
                ]
            ]
        ]
    ],
    'params' => $params
];
