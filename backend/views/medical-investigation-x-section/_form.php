<?php

use backend\models\Dictionary;
use backend\models\DictionaryDetail;
use backend\models\Internment;
use backend\models\Medicalinvestigation;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\User;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MedicalinvestigationXSection */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medicalinvestigation-xsection-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UserId')->hiddenInput(['value' => Yii::$app->user->getId()])->label(false) ?>

    <?= $form->field($model, 'MedicalInvestigationId')->dropDownList(
        ArrayHelper::map(MedicalInvestigation::find()->all(), 'Id', 'Name')
    )->label('Selectați Investigația medicală') ?>


    <?= $form->field($model, 'SectionId')->dropDownList(
        ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId'=>Dictionary::SECTION])->all(), 'Id', 'Name')
    )->label('Selectați secția') ?>

    <?= $form->field($model, 'InternmentId')->dropDownList(
        ArrayHelper::map(Internment::find()->all(), 'Id', 'Id')
    )->label('Selectați internarea #') ?>
    <?php if (!$model->isNewRecord) { ?>
        <?= $form->field($model, 'StatusId')->dropDownList(ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::GENERAL_STATUS])->all(), 'Id', 'Name'))->label('Selectați status') ?>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Creați' : 'Modificați', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
