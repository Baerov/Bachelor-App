<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MedicalInvestigation */

$this->title = 'Modificați Investigația Medicală: ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Investigații Medicale', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="medical-investigation-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
