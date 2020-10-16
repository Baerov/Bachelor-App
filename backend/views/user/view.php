<?php

use backend\models\DictionaryDetail;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Utilizatori', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$sections = '';
foreach ($model->getUserXSections()->all() as $section) {
    $sections .= $section->getSection()->One()->Name . ', ';
}
?>
<div class="user-view">


    <p>
        <?= Html::a('Modificați', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Ștergeți', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Sunteți siguri că doriți să ștergeți acest obiect?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php
    $userType = '';
    if ($model->type_id == DictionaryDetail::DOCTOR) {
        $userType = 'Medic';
    } elseif ($model->type_id == DictionaryDetail::MEDICAL_ASSISTANT) {
        $userType = 'Asistent Medical';
    } else {
        $userType = 'Admin';
    }
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'type_id',
                'value' => $userType
            ],
            'username',
			            [
                'attribute' => 'section',
                'value' => $sections ? $sections : '-',
            ],
            'auth_key',
            'email:email',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
</div>
