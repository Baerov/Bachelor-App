<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MedicalinvestigationXSection */

$this->title = $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Cereri investigație medicale', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medicalinvestigation-xsection-view">

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
            'Id',
            [
                'attribute' => 'UserId',
                'value' => $model->getUser()->one()->username,
            ],
            [
                'attribute' => 'MedicalInvestigationId',
                'value' => $model->getMedicalInvestigation()->one()->Name,
            ],
            [
                'attribute' => 'SectionId',
                'value' => $model->getSection()->one()->Name,
            ],
            'created_at:datetime',
        ],
    ]) ?>

</div>
