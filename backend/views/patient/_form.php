<?php

use backend\models\Dictionary;
use backend\models\DictionaryDetail;
use backend\models\InterestPoint;
use backend\models\InterestPointXPatient;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Patient */
/* @var $form yii\widgets\ActiveForm */

$js = <<<JS
$("#patient-categoryid").change(function () {
    $('.category-checkbox input').attr('checked', false);
    $('.category-checkbox').hide();
    var catId = $(this).val();
    $('.category-'+catId).show();
});

JS;

$this->registerJs($js);


$user_type = Yii::$app->user->identity->type_id;
?>

<div class="patient-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $interestPoints = ArrayHelper::getColumn($model->getInterestPointXPatients()->all(), 'InterestPointId');
    foreach (InterestPoint::find()->all() as $interest) {
        $checked = false;
        $exist = false;
        if ($interest->CategoryId == $model->CategoryId) {
            $exist = true;
            if (in_array($interest->Id, $interestPoints)) {
                $checked = true;
            }
        }
        ?>
        <label <?php if (!$exist) { ?> style='display:none;' <?php } ?>
            class="category-checkbox category-<?php echo $interest->CategoryId ?>">
            <?= Html::checkbox('Patient[interestPoint][]', $checked, ['value' => $interest->Id]); ?>
            <?= $interest->Name ?>
        </label>
    <?php } ?>
    <?= $form->field($model, 'CategoryId')->dropDownList(ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::PATIENT_CATEGORY])->all(), 'Id', 'Name'))->label('Categorie') ?>

    <?= $form->field($model, 'CityId')->dropDownList(ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::CITY])->all(), 'Id', 'Name'))->label('Oraș') ?>

    <?php if ($user_type == DictionaryDetail::ADMIN) { ?>

        <?= $form->field($model, 'SectionId')->dropDownList(ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::SECTION])->all(), 'Id', 'Name'))->label('Secție') ?>

    <?php } ?>
    <?php if ($user_type == DictionaryDetail::DOCTOR) { ?>

        <?= $form->field($model, 'SectionId')->dropDownList(ArrayHelper::map(DictionaryDetail::find()->innerJoinWith('userXSections', 'userXSections.SectionId = DictionaryDetail.Id')->where(['DictionaryId' => Dictionary::SECTION])->andWhere(['UserId' => Yii::$app->user->id])->all(), 'Id', 'Name'))->label('Secție') ?>

    <?php } ?>
    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MobilePhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>

    <?php if (!$model->isNewRecord) { ?>
        <?= $form->field($model, 'StatusId')->dropDownList(ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::PATIENT_STATUS])->all(), 'Id', 'Name'))->label('Stare') ?>
    <?php } ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Creați' : 'Modificați', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
