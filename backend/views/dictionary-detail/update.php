<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DictionaryDetail */

$this->title = 'Update Dictionary Detail: ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Dictionary Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dictionary-detail-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
