<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\search\InterestPointXPatientSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="interest-point-xpatient-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'InterestPointId') ?>

    <?= $form->field($model, 'PatientId') ?>

    <?= $form->field($model, 'Enabled') ?>

    <?= $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Căutați', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Resetați', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
