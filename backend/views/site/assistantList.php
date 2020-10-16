<?php
use backend\models\Patient;
use backend\models\Dictionary;
use backend\models\DictionaryDetail;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $priorityInternmentSearchModel backend\search\InternmentSearch */
/* @var $searchModelInternment backend\search\InternmentSearch */
/* @var $priorityInternmentDataProvider yii\data\ActiveDataProvider */
/* @var $dataProviderInternment yii\data\ActiveDataProvider */

?>
<h4>Consultații întârziate</h4>
<?= GridView::widget([
    'dataProvider' => $priorityInternmentDataProvider,
    'filterModel' => $priorityInternmentSearchModel,
    'layout' => "{items}\n{pager}",
    'options' => [
        'class' => 'bg-danger',
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'PatientId',
            'value' => function ($data) {
                return $data->getPatient()->one()->Name;
            },
            'filter' => ArrayHelper::map(
                Patient::findBySql('SELECT p.Id, p.Name FROM Patient p INNER JOIN UserXSection s ON s.SectionId = p.SectionId WHERE p.Enabled = 1 and s.Enabled = 1 and s.UserId = :uid;',
                    ['uid' => Yii::$app->user->getId()])->all(), 'Id', 'Name'),
        ],
        'Date',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}{update}',
            'buttons' => [
                'view' => function ($url, $data) {
                    return Html::a('<span class="col-md-6 icon-info"></span>', ['internment/view', 'id' => $data->Id], ['aria-label' => 'view', 'title' => 'Vizualizați internare']);
                },
                'update' => function ($url, $data) {
                    return Html::a('<span class="col-md-6 icon-note"></span>', ['internment/update', 'id' => $data->Id], ['aria-label' => 'update', 'title' => 'Modificați internare']);
                },
            ],
        ],
    ],
]); ?>
<h4>Consultații cu regim normal</h4>
<?= GridView::widget([
    'dataProvider' => $dataProviderInternment,
    'filterModel' => $searchModelInternment,
    'layout' => "{items}\n{pager}",
    'options' => [
        'class' => 'bg-info',
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'PatientId',
            'value' => function ($data) {
                return $data->getPatient()->one()->Name;
            },
            'filter' => ArrayHelper::map(
                Patient::findBySql('SELECT p.Id, p.Name FROM Patient p INNER JOIN UserXSection s ON s.SectionId = p.SectionId WHERE p.Enabled = 1 and s.Enabled = 1 and s.UserId = :uid;',
                    ['uid' => Yii::$app->user->getId()])->all(), 'Id', 'Name'),
        ],
        'Date',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}{update}',
            'buttons' => [
                'view' => function ($url, $data) {
                    return Html::a('<span class="col-md-6 icon-info"></span>', ['internment/view', 'id' => $data->Id], ['aria-label' => 'view', 'title' => 'Vizualizați internare']);
                },
                'update' => function ($url, $data) {
                    return Html::a('<span class="col-md-6 icon-note"></span>', ['internment/update', 'id' => $data->Id], ['aria-label' => 'update', 'title' => 'Modificați internare']);
                },
            ],
        ],
    ],
]); ?>
