<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Patient */

$this->title = 'Creare Pacient';
$this->params['breadcrumbs'][] = ['label' => 'Pacienți', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
