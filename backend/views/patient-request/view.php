<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PatientRequest */

$this->title = $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Log Pacienți', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificați', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Stergeți', ['delete', 'id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Sunteți siguri că doriți să ștergeți acest obiect?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'UserId',
            'PatientId',
            'RecallDate',
        ],
    ]) ?>

</div>
