<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\search\DictionaryDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stări';
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
                'template'=>'{view}{update}',
                'buttons' => [
                    'view' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-info"></span>', ['status/view', 'id' => $data->Id], ['title' => 'Vizualizați status']);
                    },
                    'update' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-note"></span>', ['status/update', 'id' => $data->Id], ['title' => 'Modificați status']);
                    },
                    'delete' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-ban"></span>', ['status/delete', 'id' => $data->Id], ['aria-label'=>'delete', 'data-confirm'=>'Sunteți siguri că doriți să ștergeți acest obiect?', 'data-method'=>'post', 'data-pjax'=>'0', 'title' => 'Ștergeți status']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
