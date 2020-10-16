<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Patient */

$this->title = 'Modificare Pacient: ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Pacienți', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="patient-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
