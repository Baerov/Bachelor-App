<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserXSection */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-xsection-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <?= $form->field($model, 'SectionId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Creați' : 'Modificați', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
