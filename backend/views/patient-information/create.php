<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PatientInformation */

$this->title = 'Creare Informație Pacient';
$this->params['breadcrumbs'][] = ['label' => 'Informații Pacienți', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-information-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
