<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Creare Utilizator';
$this->params['breadcrumbs'][] = ['label' => 'Utilizatori', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
