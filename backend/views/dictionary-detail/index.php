<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\search\DictionaryDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detalii Dicționar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-detail-index">
    <p>
        <?= Html::a('Create Detalii Dicționar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'Name',
            'Code',
            'Value',
            'Default',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}',
                'buttons' => [
                    'view' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-info"></span>', ['dictionary-detail/view', 'id' => $data->Id], ['title' => 'Vizualizați detaliu dicționar']);
                    },
                    'update' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-note"></span>', ['dictionary-detail/update', 'id' => $data->Id], ['title' => 'Modificați detaliu dicționar']);
                    },
                    'delete' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-ban"></span>', ['dictionary-detail/delete', 'id' => $data->Id], ['aria-label'=>'delete', 'data-confirm'=>'Sunteți siguri că doriți să ștergeți acest obiect?', 'data-method'=>'post', 'data-pjax'=>'0', 'title' => 'Ștergeți detaliu dicționar']);
                    },
                ],

            ],
        ],
    ]); ?>
</div>
