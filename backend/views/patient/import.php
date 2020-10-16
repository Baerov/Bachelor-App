<?php

use backend\models\Dictionary;
use backend\models\DictionaryDetail;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Patient */
/* @var $form yii\widgets\ActiveForm */
/* @var $import [] */

?>

<div class="patient-form">
    <?php if ($import['total'] > 0) { ?>
        <?php
        $n = '<br/>';
        echo Html::beginTag('div', ['class' => 'alert alert-info']);
        echo "Total pacienți: " . $import['total'] . $n;
        echo Html::endTag('div');

        echo Html::beginTag('div', ['class' => 'alert alert-success']);
        echo "Pacienți importați:" . $import['success'] . $n;
        echo Html::endTag('div');

        echo Html::beginTag('div', ['class' => 'alert alert-warning']);
        echo "Pacienți neimportați: " . $import['error'] . $n;
        echo Html::endTag('div');

        echo Html::beginTag('div', ['class' => 'alert alert-info']);
        echo $import['newSections'] . " NOI secții importate" . $n;
        echo $import['newCities'] . " NOI orașe importate" . $n;
        echo Html::endTag('div');

        ?>
    <?php } else { ?>
        <?php
        echo Html::a('Descărcați template-ul excel pentru import', Yii::getAlias('@web') . '/import-template.xlsx');
        ?>
        <?php $form = ActiveForm::begin(
            ['options' =>
                [
                    'enctype' => 'multipart/form-data',
                ]
            ]); ?>
        <?= $form->field($model, 'CategoryId')->dropDownList(ArrayHelper::map(DictionaryDetail::find()
            ->where(['DictionaryId' => Dictionary::PATIENT_CATEGORY])
            ->all(), 'Id', 'Name'), ['prompt' => '-']) ?>

        <?= $form->field($model, 'file')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Importați datele', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    <?php } ?>
</div>