<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserXSection */

$this->title = 'Creare Utilizator X Secție';
$this->params['breadcrumbs'][] = ['label' => 'Utilizator X Secții', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-xsection-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
