<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Modificare Utilizator: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Utilizatori', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificare';
?>
<div class="user-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
