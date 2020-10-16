<?php

use backend\models\Dictionary;
use backend\models\DictionaryDetail;
use backend\models\InterestPoint;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel backend\search\PatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

    $this->title = 'Pacienți';
$this->params['breadcrumbs'][] = $this->title;

$template = '';
if (Yii::$app->user->identity->type_id == DictionaryDetail::ADMIN) {
    $template = '{view}{update}{delete}{create_appointment}';
} elseif (Yii::$app->user->identity->type_id == DictionaryDetail::DOCTOR) {
    $template = '{view}{update}{create_appointment}';
} else {
    $template = '{view}';
}
?>
<div class="patient-index">

    <?= GridView::widget(['dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [['class' => 'yii\grid\SerialColumn'],
            'Name',
            [
                'attribute' => 'SectionId',
                'value' => function ($data) {
                    $string = '';
                    $string .= $data->getSection()->one()->Name;
                    return $string;
                },
                'filter' => ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::SECTION])->all(), 'Id', 'Name'),
                'visible' => Yii::$app->user->can('addUser')
            ],
            [
                'attribute' => 'CityId',
                'value' => function ($data) {
                    $string = '';
                    $string .= $data->getCity()->one()->Name;
                    return $string;
                },
                'filter' => ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::CITY])->all(), 'Id', 'Name'),
            ],
            [
                'attribute' => 'CategoryId',
                'value' => function ($data) {
                    $string = '-';
                    if ($data->CategoryId) {
                        $string = $data->getCategory()->one()->Name;
                    }
                    return $string;
                },
                'filter' => ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::PATIENT_CATEGORY])->all(), 'Id', 'Name'),
            ],
            [
                'attribute' => 'StatusId',
                'value' => function ($data) {
                    $string = '-';
                    if ($data->StatusId) {
                        $string = $data->getStatus()->one()->Name;
                    }
                    return $string;
                },
                'filter' => ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::PATIENT_STATUS])->all(), 'Id', 'Name'),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => $template,
                'buttons' => [
                    'view' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-info"></span>', ['patient/view', 'id' => $data->Id], ['aria-label'=>'view','title' => 'Vizualizați pacient']);
                    },
                    'update' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-note"></span>', ['patient/update', 'id' => $data->Id], ['aria-label'=>'update','title' => 'Modificați pacient']);
                    },
                    'delete' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-ban"></span>', ['patient/delete', 'id' => $data->Id], ['aria-label'=>'delete', 'data-confirm'=>'Sunteți siguri că doriți să ștergeți acest obiect?', 'data-method'=>'post', 'data-pjax'=>'0', 'title' => 'Ștergeți pacient']);
                    },
                    'create_appointment' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-plus"></span>', ['internment/create', 'PatientId' => $data->Id], ['title' => 'Creare internare']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
