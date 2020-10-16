<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PatientInformation */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Informații Pacienți', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-information-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificați', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Ștergeți', ['delete', 'id' => $model->Id], [
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
            'PatientId',
            'Name',
            'Value',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
