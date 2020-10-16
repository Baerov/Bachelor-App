<?php

use backend\models\Patient;
use backend\models\Dictionary;
use backend\models\DictionaryDetail;
use backend\models\User;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Internment */
/* @var $form yii\widgets\ActiveForm */
/** @var Patient $patientModel */

?>

<div class="internment-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    if (Yii::$app->user->identity->type_id == DictionaryDetail::ADMIN) { ?>
        <?= $form->field($model, 'DoctorId')->dropDownList(
            ArrayHelper::map(User::findAll(['type_id' => DictionaryDetail::DOCTOR]), 'id', 'username')
        )->label('Selectați Medic') ?>
    <?php }
    if (Yii::$app->user->identity->type_id == DictionaryDetail::DOCTOR || Yii::$app->user->identity->type_id == DictionaryDetail::ADMIN) { ?>
        <?=
        $form->field($model, 'MedicalAssistantId')->dropDownList(
            ArrayHelper::map(User::findBySql('SELECT u.id, u.username FROM user u INNER JOIN UserXSection x ON x.UserId = u.id WHERE u.Enabled = 1 and x.Enabled = 1 and u.type_id = :type_id AND x.SectionId = :section_id', ['type_id' => DictionaryDetail::MEDICAL_ASSISTANT, 'section_id' => $patientModel->SectionId])->all(), 'id', 'username')
        )->label('Selectați Asistent Medical')
        ?>

        <?= $form->field($model, 'Date')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => 'Introduceți data și ora internării...'],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd hh:i:s'
            ]
        ]); ?>
    <?php }
    if (Yii::$app->user->identity->type_id == DictionaryDetail::MEDICAL_ASSISTANT || Yii::$app->user->identity->type_id == DictionaryDetail::ADMIN) { ?>
        <?= $form->field($model, 'Comment')->textarea(); ?>
    <?php } ?>
    <?php if (!$model->isNewRecord) { ?>
        <?= $form->field($model, 'Status')->dropDownList(ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::GENERAL_STATUS])->all(), 'Id', 'Name'))->label('Selectați starea internării') ?>
        <?= $form->field($model, 'ExtraStatus')->dropDownList(ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::EXTRA_STATUS])->all(), 'Id', 'Name'))->label('Selectați starea extra') ?>
    <?php } ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Creați' : 'Modificați', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
