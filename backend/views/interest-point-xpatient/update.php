<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InterestPointXPatient */

$this->title = 'Modificare Punct de Interes X Pacient: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Punct de Interes X Pacienți', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Modificare';
?>
<div class="interest-point-xpatient-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
