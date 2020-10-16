<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PatientRequest */

$this->title = 'Creare Log Pacient';
$this->params['breadcrumbs'][] = ['label' => 'Log Pacienți', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
