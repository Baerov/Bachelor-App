<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DictionaryDetail */

$this->title = 'Creare Status Pacient';
$this->params['breadcrumbs'][] = ['label' => 'Statusuri Pacienți', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-detail-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
