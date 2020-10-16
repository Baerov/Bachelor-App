<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PatientRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <?= $form->field($model, 'PatientId')->textInput() ?>

    <?= $form->field($model, 'RecallDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Creați' : 'Modificați', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
