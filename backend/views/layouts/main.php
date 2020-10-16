<?php

/** @var $this \yii\web\View */
use backend\models\DictionaryDetail;
use lajax\languagepicker\widgets\LanguagePicker;
use yii\helpers\Html;
use dlds\metronic\helpers\Layout;
use backend\widgets\Menu;
use dlds\metronic\widgets\NavBar;
use dlds\metronic\widgets\Nav;
use dlds\metronic\widgets\Breadcrumbs;
use dlds\metronic\Metronic;
use yii\helpers\Url;
use backend\assets\AppAsset;

$asset = Metronic::registerThemeAsset($this);
AppAsset::register($this);
$directoryAsset = Yii::$app->assetManager->getPublishedUrl($asset->sourcePath);
$metronicImg = $directoryAsset . '/layouts/layout/img';

$this->beginPage();
?>
    <!DOCTYPE html>
    <!--[if IE 8]>
    <html lang="en" class="ie8 no-js"> <![endif]-->
    <!--[if IE 9]>
    <html lang="en" class="ie9 no-js"> <![endif]-->
    <!--[if !IE]><!-->
    <html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta name="MobileOptimized" content="320">
        <link rel="shortcut icon" href="favicon.ico"/>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

        <?php
//        $this->registerJsFile(Url::to('../js/jquery.flot.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);
//        $this->registerJsFile(Url::to('../js/jquery.flot.pie.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);
        ?>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body <?= Layout::getHtmlOptions('body', ['class' => 'page-header-fixed page-sidebar-closed-hide-logo page-content-white'], true) ?> >
    <?php $this->beginBody() ?>
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        <?php
        NavBar::begin(
            [
                'brandLabel' => 'MorningSide',
                'brandLogoUrl' => Yii::getAlias('@img') . '/logo.png',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => Layout::getHtmlOptions('header', false),
            ]
        );
        ?>
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
        <?php
        echo Nav::widget([
            'position' => Nav::POS_RIGHT,
            'items' => [
                [
                    'label' => Nav::userItem(
                        isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username . '<i class="fa fa-angle-down"></i>' : null,
                        $metronicImg . '/avatar.png'
                    ),
                    'dropdownType' => Nav::TYPE_USER,
                    'items' => [
                        [
                            'label' => 'LogOut',
                            'icon' => 'icon-key',
                            'url' => [
                                '/site/logout',
                                'id' => Yii::$app->user->id,
                                'tag' => 'popular'
                            ],
                            'linkOptions' => ['data-method' => 'post'],
                        ],
                    ],
                    'visible' => !Yii::$app->user->isGuest
                ],
            ],
        ]);
        ?>
    </div>
    <!-- END TOP NAVIGATION MENU -->

    <?php NavBar::end(); ?>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <?=
    (Metronic::getComponent() && Metronic::getComponent()->layoutOption == Metronic::LAYOUT_BOXED) ?
        Html::beginTag('div', ['class' => 'container']) : '';
    ?>
    <div class="clearfix"></div>


    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->


        <?php
        // Important: you need to specify url as 'controller/action',
        // not just as 'controller' even if default action is used.
        echo Menu::widget([
            'items' => [
                [
                    'label' => 'Dashboard',
                    'url' => ['site/index'],
                    'icon' => 'icon-home',
                    'visible' => !Yii::$app->user->isGuest && !Yii::$app->user->can('addUser'),
                ],
                [
                    'label' => 'Agendă Internări',
                    'url' => ['calendar/index'],
                    'icon' => 'icon-calendar',
                    'visible' => !Yii::$app->user->isGuest,
                ],
                [
                    'label' => 'Utilizatori',
                    'template' => '<a href="{url}" class="nav-link nav-toggle">{icon}{label}{badge}{arrow}</a>',
                    'options' => ['class' => 'nav-item'],
                    'icon' => 'icon-users',
                    'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('addUser'),

                    'items' => [
                        [
                            'label' => 'Utilizatori',
                            'url' => ['user/index'],
                            'icon' => 'icon-user',
                        ],
                        [
                            'label' => 'Administratori',
                            'url' => ['user/index', 'UserSearch[type_id]' => DictionaryDetail::ADMIN],
                            'icon' => 'icon-user',
                        ],
                        [
                            'label' => 'Doctori',
                            'url' => ['user/index', 'UserSearch[type_id]' => DictionaryDetail::DOCTOR],
                            'icon' => 'icon-user',
                        ],
                        [
                            'label' => 'Asistenți medicali',
                            'url' => ['user/index', 'UserSearch[type_id]' => DictionaryDetail::MEDICAL_ASSISTANT],
                            'icon' => 'icon-user',
                        ],
                    ]
                ],
                [
                    'label' => 'Adăugare',
                    'template' => '<a href="{url}" class="nav-link nav-toggle">{icon}{label}{badge}{arrow}</a>',
                    'options' => ['class' => 'nav-item'],
                    'icon' => 'icon-note',
                    'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('addPatient') || Yii::$app->user->can('addInternment') || Yii::$app->user->can('setStatus') || Yii::$app->user->can('addUser'),

                    'items' => [
                        [
                            'label' => 'Utilizator',
                            'url' => ['user/create'],
                            'icon' => 'icon-user-follow',
                            'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('addUser')
                        ],
                        [
                            'label' => 'Pacient',
                            'url' => ['patient/create'],
                            'icon' => 'icon-call-end',
                            'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('addPatient')
                        ],
                        [
                            'label' => 'Categorie',
                            'url' => ['category/create'],
                            'icon' => 'icon-star',
                            'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('addUser')
                        ],
                        [
                            'label' => 'Oraș',
                            'url' => ['city/create'],
                            'icon' => 'icon-map',
                            'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('addUser')
                        ],
                        [
                            'label' => 'Secție',
                            'url' => ['section/create'],
                            'icon' => 'icon-pointer',
                            'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('addUser')
                        ],
                        [
                            'label' => 'Stare generală',
                            'url' => ['status/create'],
                            'icon' => 'icon-bubble',
                            'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('addUser')
                        ],
                        [
                            'label' => 'Stare pacient',
                            'url' => ['patient-status/add'],
                            'icon' => 'icon-bubble',
                            'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('addUser')
                        ],
                        [
                            'label' => 'Punct de interes',
                            'url' => ['interest-point/create'],
                            'icon' => 'icon-tag',
                            'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('addUser')
                        ],
                        [
                            'label' => 'Investigație medicală',
                            'url' => ['medical-investigation/create'],
                            'icon' => 'icon-doc',
                            'visible' => !Yii::$app->user->isGuest
                        ],
                    ]
                ],
                [
                    'label' => 'Rapoarte',
                    'template' => '<a href="{url}" class="nav-link nav-toggle">{icon}{label}{badge}{arrow}</a>',
                    'options' => ['class' => 'nav-item'],
                    'icon' => 'icon-notebook ',
                    'visible' => !Yii::$app->user->isGuest,

                    'items' => [
                        [
                            'label' => 'Pacienți',
                            'url' => ['patient/index'],
                            'icon' => 'icon-list',
                            'visible' => !Yii::$app->user->isGuest
                        ],
                        [
                            'label' => 'Internări',
                            'url' => ['internment/index'],
                            'icon' => 'icon-list',
                            'visible' => !Yii::$app->user->isGuest
                        ],
                        [
                            'label' => 'Cereri investigații',
                            'url' => ['medical-investigation-x-section/list'],
                            'icon' => 'icon-list',
                            'visible' => !Yii::$app->user->isGuest
                        ],
                        [
                            'label' => 'Categorii',
                            'url' => ['category/index'],
                            'icon' => 'icon-list',
                            'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('addUser')
                        ],
                        [
                            'label' => 'Orașe',
                            'url' => ['city/index'],
                            'icon' => 'icon-list',
                            'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('addUser')
                        ],
                        [
                            'label' => 'Secții',
                            'url' => ['section/index'],
                            'icon' => 'icon-list',
                            'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('addUser')
                        ],
                        [
                            'label' => 'Stări',
                            'url' => ['status/index'],
                            'icon' => 'icon-list',
                            'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('addUser')
                        ],
                        [
                            'label' => 'Puncte de interes',
                            'url' => ['interest-point/index'],
                            'icon' => 'icon-list',
                            'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('addUser')
                        ],
                        [
                            'label' => 'Investigații medicale',
                            'url' => ['medical-investigation/index'],
                            'icon' => 'icon-list',
                            'visible' => !Yii::$app->user->isGuest
                        ],
                    ],
                ],
                [
                    'label' => 'Importare pacienți',
                    'url' => ['patient/import'],
                    'icon' => 'icon-plus',
                    'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('addUser')
                ],
                [
                    'label' => 'Exportare pacienți',
                    'url' => ['patient/export'],
                    'icon' => 'icon-note',
                    'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('addUser')
                ],
                [
                    'label' => 'Cerere investigație medicală',
                    'url' => ['medical-investigation-x-section/add'],
                    'icon' => 'icon-doc',
                    'visible' => !Yii::$app->user->isGuest
                ],
                ['label' => 'Login', 'icon' => 'icon-lock', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
            ],

        ]);
        ?>


        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                <!-- BEGIN PAGE BAR -->
                <div class="page-bar">

                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => ['class' => '']
                    ]);
                    ?>
                </div>
                <h1 class="page-title">
                    <?= Html::encode($this->title) ?>
                </h1>
                <!-- BEGIN PAGE CONTENT-->
                <div class="row">
                    <div class="col-md-12">
                        <?= $content ?>
                    </div>
                </div>
                <!-- END PAGE CONTENT-->
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <?= (Metronic::getComponent() && Metronic::getComponent()->layoutOption == Metronic::LAYOUT_BOXED) ? Html::endTag('div') : ''; ?>
    </div>
    <?php $this->endBody() ?>

    </body>
    <!-- END BODY -->
    </html>
<?php $this->endPage() ?>