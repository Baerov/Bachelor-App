<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\search\DictionaryDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorii';
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
                        return Html::a('<span class="col-md-3 icon-info"></span>', ['category/view', 'id' => $data->Id], ['aria-label'=>'view','title' => 'Vizualizați categoria']);
                    },
                    'update' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-note"></span>', ['category/update', 'id' => $data->Id], ['aria-label'=>'update','title' => 'Modificați categoria']);
                    },
                    'delete' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-ban"></span>', ['category/delete', 'id' => $data->Id], ['aria-label'=>'delete', 'data-confirm'=>'Sunteți siguri că doriți să ștergeți acest obiect?', 'data-method'=>'post', 'data-pjax'=>'0', 'title' => 'Ștergeți categoria']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
