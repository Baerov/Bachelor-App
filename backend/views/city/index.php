<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\search\DictionaryDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orașe';
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
                        return Html::a('<span class="col-md-3 icon-info"></span>', ['city/view', 'id' => $data->Id], ['title' => 'Vizualizați oraș']);
                    },
                    'update' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-note"></span>', ['city/update', 'id' => $data->Id], ['title' => 'Modificați oraș']);
                    },
                    'delete' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-ban"></span>', ['city/delete', 'id' => $data->Id], ['aria-label'=>'delete', 'data-confirm'=>'Sunteți siguri că doriți să ștergeți acest obiect?', 'data-method'=>'post', 'data-pjax'=>'0', 'title' => 'Ștergeți oraș']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
