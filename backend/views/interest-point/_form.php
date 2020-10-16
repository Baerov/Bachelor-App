<?php

use backend\models\Dictionary;
use backend\models\DictionaryDetail;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InterestPoint */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="interest-point-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CategoryId')->dropDownList(ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::PATIENT_CATEGORY])->all(), 'Id', 'Name')) ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Creați' : 'Modificați', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
