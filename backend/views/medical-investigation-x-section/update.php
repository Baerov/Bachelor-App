<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MedicalinvestigationXSection */

$this->title = 'Modificare cerere investigație medicală: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Cereri investigație medicale', 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Modificare';
?>
<div class="medicalinvestigation-xsection-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
