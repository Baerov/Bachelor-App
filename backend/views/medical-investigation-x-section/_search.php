<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\search\MedicalInvestigationXSectionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medicalinvestigation-xsection-search">

    <?php $form = ActiveForm::begin([
        'action' => ['list'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'MedicalInvestigationId') ?>

    <?= $form->field($model, 'UserId') ?>

    <?= $form->field($model, 'InternmentId') ?>

    <?= $form->field($model, 'Enabled') ?>


    <div class="form-group">
        <?= Html::submitButton('Căutați', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Resetați', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
