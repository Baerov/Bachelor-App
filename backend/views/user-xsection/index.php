<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\search\UserXSectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utilizator X Secții';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-xsection-index">

    <p>
        <?= Html::a('Create User XSection', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'UserId',
            'SectionId',

            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-info"></span>', ['user-xsection/view', 'id' => $data->Id], ['title' => 'Vizualizați utilizator x secție']);
                    },
                    'update' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-note"></span>', ['user-xsection/update', 'id' => $data->Id], ['title' => 'Modificați utilizator x secție']);
                    },
                    'delete' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-ban"></span>', ['user-xsection/delete', 'id' => $data->Id], ['aria-label'=>'delete', 'data-confirm'=>'Sunteți siguri că doriți să ștergeți acest obiect?', 'data-method'=>'post', 'data-pjax'=>'0', 'title' => 'Ștergeți utilizator x secție']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
