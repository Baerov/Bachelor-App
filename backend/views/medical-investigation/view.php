<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MedicalInvestigation */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Investigații Medicale', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medical-investigation-view">

    <p>
        <?= Html::a('Modificare', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Ștergere', ['delete', 'id' => $model->Id], [
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
            'Name',
        ],
    ]) ?>

</div>
