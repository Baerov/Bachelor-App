<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MedicalinvestigationXSection */

$this->title = 'Cerere Investigație medicală';
$this->params['breadcrumbs'][] = ['label' => 'Cereri investigație medicale', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medicalinvestigation-xsection-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
