<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\InterestPoint */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Puncte de Interes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interest-point-view">

    <p>
        <?= Html::a('Modificați', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Ștergeți', ['delete', 'id' => $model->Id], [
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
            [
                'label' => 'Categorie',
                'attribute' => 'CategoryId',
                'value' => $model->getCategory()->one()->Name,
            ],
            'Name',
        ],
    ]) ?>

</div>
