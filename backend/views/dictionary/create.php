<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Dictionary */

$this->title = 'Creare Dicționar';
$this->params['breadcrumbs'][] = ['label' => 'Dicționare', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
