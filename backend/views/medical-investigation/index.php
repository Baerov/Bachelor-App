<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\search\MedicalInvestigationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Investigații Medicale';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medical-investigation-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'Name',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}',
                'buttons' => [
                    'view' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-info"></span>', ['medical-investigation/view', 'id' => $data->Id], ['title' => 'Vizualizați investigația medicală']);
                    },
                    'update' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-note"></span>', ['medical-investigation/update', 'id' => $data->Id], ['title' => 'Modificați investigația medicală']);
                    },
                    'delete' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-ban"></span>', ['medical-investigation/delete', 'id' => $data->Id], ['aria-label'=>'delete', 'data-confirm'=>'Sunteți siguri că doriți să ștergeți acest obiect?', 'data-method'=>'post', 'data-pjax'=>'0', 'title' => 'Ștergeți investigația medicală']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
