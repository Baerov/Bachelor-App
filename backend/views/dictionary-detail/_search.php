<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\search\DictionaryDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dictionary-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Name') ?>

    <?= $form->field($model, 'Code') ?>

    <?= $form->field($model, 'Value') ?>

    <?= $form->field($model, 'Default') ?>

    <div class="form-group">
        <?= Html::submitButton('Căutați', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Resetați', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
