<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InterestPointXPatient */

$this->title = $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Punct de Interes X Pacienți', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interest-point-xpatient-view">


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
            'InterestPointId',
            'PatientId',
            'Enabled',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
