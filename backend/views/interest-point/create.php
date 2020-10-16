<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InterestPoint */

$this->title = 'Creare Punct de Interes';
$this->params['breadcrumbs'][] = ['label' => 'Puncte de Interes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interest-point-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
