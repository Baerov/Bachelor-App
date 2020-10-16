<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\search\PatientRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log Pacienți';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-request-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            [
                'attribute' => 'UserId',
                'value' => function ($data) {
                    $string = '';
                    $string .= $data->getUser()->one()->username;
                    return $string;
                },
            ],
            [
                'attribute' => 'PatientId',
                'value' => function ($data) {
                    $string = '';
                    $string .= $data->getPatient()->one()->Name;
                    return $string;
                },
            ],
            'RecallDate',
            'created_at:datetime',
        ],
    ]); ?>
</div>
