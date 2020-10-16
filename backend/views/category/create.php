<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DictionaryDetail */

$this->title = 'Creare Categorie';
$this->params['breadcrumbs'][] = ['label' => 'Categorii', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-detail-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
