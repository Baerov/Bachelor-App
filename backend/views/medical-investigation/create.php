<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MedicalInvestigation */

$this->title = 'Creare Investigație Medicală';
$this->params['breadcrumbs'][] = ['label' => 'Investigații Medicale', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medical-investigation-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
