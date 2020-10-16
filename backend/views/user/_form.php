<?php

use backend\models\Dictionary;
use backend\models\DictionaryDetail;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($model->type_id == DictionaryDetail::DOCTOR || $model->type_id == DictionaryDetail::MEDICAL_ASSISTANT) { ?>
        <?= $form->field($model, 'section')->dropDownList(ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::SECTION])->all(), 'Id', 'Name'), ['multiple' => 'multiple']) ?>
    <?php } ?>

    <?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::USER_TYPE])->all(), 'Id', 'Name')) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php if ($model->isNewRecord) { ?>
        <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true])->label('Parolă') ?>
    <?php } ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Creați' : 'Modificați', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
