<?php

use backend\models\Patient;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\search\PatientInformationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Informații Pacienți';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Patient-information-index">

    <p>
        <?= Html::a('Creare Informație Pacient', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            [
                'attribute' => 'PatientId',
                'value' => function ($data) {
                    return $data->getPatient()->one()->Name;
                },
                'filter' => ArrayHelper::map(Patient::find()->all(), 'Id', 'Name'),
            ],
            'Name',
            'Value',
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-info"></span>', ['patient-information/view', 'id' => $data->Id], ['title' => 'Vizualizați info pacient']);
                    },
                    'update' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-note"></span>', ['patient-information/update', 'id' => $data->Id], ['title' => 'Update info pacient']);
                    },
                    'delete' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-ban"></span>', ['patient-information/delete', 'id' => $data->Id], ['aria-label'=>'delete', 'data-confirm'=>'Sunteți siguri că doriți să ștergeți acest obiect?', 'data-method'=>'post', 'data-pjax'=>'0', 'title' => 'Ștergeți info pacient']);
                    },
                ],],
        ],
    ]); ?>
</div>
