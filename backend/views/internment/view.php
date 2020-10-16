<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Internment */

$this->title = 'Internarea numărul #' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Internări', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="internment-view">


    <p>
        <?= Html::a('Modificați', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'DoctorId',
                'value' => $model->getDoctor()->one()->username,
            ],
            [
                'attribute' => 'MedicalAssistantId',
                'value' => $model->getMedicalAssistant()->one()->username,
            ],
            [
                'attribute' => 'PatientId',
                'value' => $model->getPatient()->one()->Name,
            ],
            [
                'attribute' => 'Status',
                'value' => $model->getStatus()->one()->Name,
            ],
        ],
    ]) ?>

</div>
