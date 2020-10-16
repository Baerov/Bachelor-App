<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\search\InterestPointXPatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Punct de Interes X Pacienți';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interest-point-xpatient-index">

    <p>
        <?= Html::a('Creare Punct de Interes X Pacient', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'InterestPointId',
            'PatientId',
            'Enabled',
            'created_at',
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-info"></span>', ['interest-point-xpatient/view', 'id' => $data->Id], ['title' => 'Vizualizați punct de interes x pacient']);
                    },
                    'update' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-note"></span>', ['interest-point-xpatient/update', 'id' => $data->Id], ['title' => 'Modificați punct de interes x pacient']);
                    },
                    'delete' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-ban"></span>', ['interest-point-xpatient/delete', 'id' => $data->Id], ['aria-label'=>'delete', 'data-confirm'=>'Sunteți siguri că doriți să ștergeți acest obiect?', 'data-method'=>'post', 'data-pjax'=>'0', 'title' => 'Ștergeți punct de interes x pacient']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
