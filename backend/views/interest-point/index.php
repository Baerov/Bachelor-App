<?php

use backend\models\Dictionary;
use backend\models\DictionaryDetail;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\search\InterestPointSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Puncte de Interes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interest-point-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'CategoryId',
                'value' => function ($data) {
                    return $data->getCategory()->one()->Name;
                },
                'filter' => ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::PATIENT_CATEGORY])->all(), 'Id', 'Name'),
            ],
            'Name',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}',
                'buttons' => [
                    'view' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-info"></span>', ['interest-point/view', 'id' => $data->Id], ['title' => 'Vizualizați punct de interes']);
                    },
                    'update' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-note"></span>', ['interest-point/update', 'id' => $data->Id], ['title' => 'Modificați punct de interes']);
                    },
                    'delete' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-ban"></span>', ['interest-point/delete', 'id' => $data->Id], ['aria-label'=>'delete', 'data-confirm'=>'Sunteți siguri că doriți să ștergeți acest obiect?', 'data-method'=>'post', 'data-pjax'=>'0', 'title' => 'Ștergeți punct de interes']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
