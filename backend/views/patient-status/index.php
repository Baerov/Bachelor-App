<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\search\DictionaryDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Statusuri Pacienți';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-detail-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Name',
            'Code',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}',
                'buttons' => [
                    'view' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-info"></span>', ['patient-status/view', 'id' => $data->Id], ['title' => 'Vizualizați status pacient']);
                    },
                    'update' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-note"></span>', ['patient-status/update', 'id' => $data->Id], ['title' => 'Modificați status pacient']);
                    },
                    'delete' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-ban"></span>', ['patient-status/delete', 'id' => $data->Id], ['aria-label'=>'delete', 'data-confirm'=>'Sunteți siguri că doriți să ștergeți acest obiect?', 'data-method'=>'post', 'data-pjax'=>'0', 'title' => 'Ștergeți status pacient']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
