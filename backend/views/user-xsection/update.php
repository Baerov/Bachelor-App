<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserXSection */

$this->title = 'Modificare Utilizator X Secție:' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Utilizator X Secții', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Modificare';
?>
<div class="user-xsection-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
