<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\search\UserXSectionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-xsection-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'UserId') ?>

    <?= $form->field($model, 'SectionId') ?>

    <div class="form-group">
        <?= Html::submitButton('Căutați', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Resetați', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
