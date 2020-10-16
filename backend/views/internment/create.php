<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Internment */
/* @var $patientModel backend\models\Patient */

$this->title = 'Creare Internare';
$this->params['breadcrumbs'][] = ['label' => 'Internări', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="internment-create">

    

    <?= $this->render('_form', [
        'model' => $model,
        'patientModel' => $patientModel,
    ]) ?>

</div>
