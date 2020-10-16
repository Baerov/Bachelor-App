<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Internment */
/* @var $patientModel backend\models\Patient */


$this->title = 'Modificare Internare: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Internări', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Modificare';
?>
<div class="internment-update">

    

    <?= $this->render('_form', [
        'model' => $model,
        'patientModel' => $patientModel,
    ]) ?>

</div>
