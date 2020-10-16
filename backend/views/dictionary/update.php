<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Dictionary */

$this->title = 'Modificare Dicționar: ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Dicționare', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Modificare';
?>
<div class="dictionary-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
