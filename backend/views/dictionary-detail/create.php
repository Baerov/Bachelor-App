<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DictionaryDetail */

$this->title = 'Creare Detaliu Dicționar';
$this->params['breadcrumbs'][] = ['label' => 'Detalii Dicționar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-detail-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
