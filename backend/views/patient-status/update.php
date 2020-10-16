<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DictionaryDetail */

$this->title = 'Modificare Status Pacient';
$this->params['breadcrumbs'][] = ['label' => 'Statusuri Pacienți', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificare';
?>
<div class="dictionary-detail-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
