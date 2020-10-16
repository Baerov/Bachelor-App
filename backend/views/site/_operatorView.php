<?php

use backend\models\Dictionary;
use backend\models\DictionaryDetail;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Patient */
/* @var $form yii\widgets\ActiveForm */

$js = <<<JS
$("#form-show").click(function () {
    $('#recall-form').toggle();
});
$("#form-status-show").click(function () {
    $('#status-form').toggle();
});
JS;


$this->registerJs($js);

$interests = '';
foreach ($model->getInterestPointXPatients()->all() as $interest) {
    $interests .= $interest->getInterestPoint()->One()->Name . ', ';
}

?>
<div class="Patient-view">
    <div class="row">
        <div class="col-lg-7 col-md-7 col-xs-7">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'CategoryId',
                        'value' => $model->CategoryId ? $model->getCategory()->one()->Name : '-',

                    ],
                    [
                        'attribute' => 'interestPoint',
                        'value' => $interests ? $interests : '-',

                    ],
                    [
                        'attribute' => 'CityId',
                        'value' => $model->getCity()->one()->Name,

                    ],
                    [
                        'attribute' => 'SectionId',
                        'value' => $model->getSection()->one()->Name,
                    ],
                    'Name',
                    'Address',
                    'Phone',
                    'MobilePhone',
                    'Email:email',
                    'RecallDate',
                ],
            ]) ?>
        </div>
        <div class="col-lg-5 col-md-5 col-xs-5">
            <div class="row text-center">
                <?= Html::a('Setați internare', ['internment/create', 'PatientId' => $model->Id], ['class' => 'btn btn-success', 'style' => 'margin-bottom:5px;']) ?>
            </div>
            <div class="row">
                <div class="text-center">
                    <?= Html::button($model->RecallDate == null ? 'Adăugați Dată Reprogramare' : 'Schimbați Dată Reprogramare', ['class' => 'btn btn-info', 'id' => 'form-show', 'style' => 'margin-bottom:5px;']) ?>
                </div>
                <!--        RECALL FORM-->
                <?php $form = ActiveForm::begin(['id' => 'recall-form', 'options' => [
                    'style' => 'display:none;margin-bottom:10px;',

                ],
                    'enableClientValidation' => true,
                    'enableAjaxValidation' => false,
                ]); ?>
                <?= Html::hiddenInput('Patient[Id]', $model->Id); ?>

                <?= $form->field($model, 'RecallDate')->widget(DateTimePicker::classname(), [
                    'options' => ['placeholder' => 'Introduceți dată reprogramare'],
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ])->label(false); ?>
                <div class="text-center">
                    <?= Html::submitButton($model->RecallDate == null ? 'Salvați' : 'Salvați modificările', ['class' => 'btn btn-info']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="row">
                <div class="text-center">
                    <?= Html::button('Schimbați Stare', ['class' => 'btn btn-primary text-center', 'id' => 'form-status-show', 'style' => 'margin-bottom:5px;']) ?>
                </div>
                <!--        STATUS FORM-->
                <?php $form = ActiveForm::begin(['id' => 'status-form', 'options' => [
                    'style' => 'display:none'
                ],
                    'enableClientValidation' => true,
                    'enableAjaxValidation' => false,
                ]); ?>
                <?= Html::hiddenInput('Patient[Id]', $model->Id); ?>
                <?= $form->field($model, 'StatusId')->dropDownList(ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::PATIENT_STATUS])->all(), 'Id', 'Name'))->label(false) ?>
                <div class="text-center">
                    <?= Html::submitButton('Salvați modificările', ['class' => 'btn btn-primary text-center']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>