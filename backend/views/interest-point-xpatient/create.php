<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InterestPointXPatient */

$this->title = 'Creare Punct de Interes X Pacient';
$this->params['breadcrumbs'][] = ['label' => 'Punct de Interes X Pacient', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interest-point-xpatient-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
