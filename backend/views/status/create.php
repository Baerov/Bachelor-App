<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DictionaryDetail */

$this->title = 'Creare Stare';
$this->params['breadcrumbs'][] = ['label' => 'Stări', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-detail-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
