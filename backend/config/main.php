<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'language' => 'ro',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log', 'metronic', 'backend\components\Aliases'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'backend\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'metronic' => [
            'class' => 'dlds\metronic\Metronic',
            'resources' => realpath(__DIR__ . '/../web/metronic/theme/assets'),
            'version' => \dlds\metronic\Metronic::VERSION_1,
            'style' => \dlds\metronic\Metronic::STYLE_SQUARE,
            'theme' => \dlds\metronic\Metronic::THEME_DARK,
            'layoutOption' => \dlds\metronic\Metronic::LAYOUT_FLUID,
            'headerOption' => \dlds\metronic\Metronic::HEADER_FIXED,
            'headerDropdown' => \dlds\metronic\Metronic::HEADER_DROPDOWN_LIGHT,
            'sidebarPosition' => \dlds\metronic\Metronic::SIDEBAR_POSITION_LEFT,
            'sidebarOption' => \dlds\metronic\Metronic::SIDEBAR_MENU_ACCORDION,
            'footerOption' => \dlds\metronic\Metronic::FOOTER_FIXED,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
    'params' => $params,
];
