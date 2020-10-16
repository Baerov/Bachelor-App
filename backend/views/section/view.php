<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DictionaryDetail */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Secții', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-detail-view">

    <p>
        <?= Html::a('Modificati', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Stergeti', ['delete', 'id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Sunteți siguri că doriți să ștergeți acest obiect?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Name',
            'Code',
        ],
    ]) ?>

</div>
