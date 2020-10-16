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
/* @var $extraInfoModel backend\models\PatientInformation */
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

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Pacienți', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$interests = '';
foreach ($model->getInterestPointXPatients()->all() as $interest) {
    $interests .= $interest->getInterestPoint()->One()->Name . ', ';
}

?>
<div class="patient-view">


    <p>
        <?php if(Yii::$app->user->identity->type_id == DictionaryDetail::ADMIN || Yii::$app->user->identity->type_id == DictionaryDetail::DOCTOR ){ ?>
        <?= Html::a('Modificați', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?php } ?>
        <?php if (Yii::$app->user->identity->type_id == DictionaryDetail::ADMIN) { ?>
            <?= Html::a('Ștergeți', ['delete', 'id' => $model->Id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Sunteți siguri că doriți să ștergeți acest obiect?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
        <?php if(Yii::$app->user->identity->type_id == DictionaryDetail::ADMIN || Yii::$app->user->identity->type_id == DictionaryDetail::DOCTOR ){ ?>
        <?= Html::a('Setați internare', ['internment/create', 'PatientId' => $model->Id], ['class' => 'btn btn-success']) ?>
        <?= Html::button($model->RecallDate==null ? 'Adaugați dată reprogramare' : 'Ștergeți dată reprogramare', ['class' => 'btn btn-info', 'id' => 'form-show']) ?>
       <?php } ?>
        <?= Html::button('Schimbați status', ['class' => 'btn btn-warning', 'id' => 'form-status-show']) ?>

        <?php $form = ActiveForm::begin(['id' => 'recall-form', 'options' => [
            'style' => 'display:none'
        ]]); ?>
        <?php if ($model->RecallDate == null) { ?>
            <?= $form->field($model, 'RecallDate')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'Introduceți dată reprogramare'],
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ]); ?>
            <?= Html::submitButton('Salvați', ['class' => 'btn btn-success']) ?>
        <?php } else { ?>
            <?= Html::hiddenInput('Patient[RecallDate]', null); ?>
            <?= Html::submitButton('Ștergeți dată reprogramare', ['class' => 'btn btn-danger']) ?>
            <?= Html::label($model->RecallDate); ?>
        <?php } ?>
        <?php ActiveForm::end(); ?>

        <?php $form = ActiveForm::begin(['id' => 'status-form', 'options' => [
            'style' => 'display:none'
        ]]); ?>
        <?= $form->field($model, 'StatusId')->dropDownList(ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::PATIENT_STATUS])->all(), 'Id', 'Name'))->label('Stare') ?>
        <?= Html::submitButton('Schimbați status', ['class' => 'btn btn-info']) ?>
        <?php ActiveForm::end(); ?>


    </p>

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
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
    <?php if ($extraInfoModel) { ?>
        <h4>Informații extra</h4>
        <?php
        foreach ($extraInfoModel as $extraInfo) {
            echo DetailView::widget([
                'model' => $extraInfoModel,
                'attributes' => [
                    [
                        'label' => $extraInfo->Name,
                        'value' => $extraInfo->Value,
                        'contentOptions'=>['class'=>'col-md-6 bg-white'],
                    ],
                ],
            ]);
        }
    }
    ?>

</div>
