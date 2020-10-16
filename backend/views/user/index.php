<?php

use backend\models\Dictionary;
use backend\models\DictionaryDetail;
use backend\models\UserXSection;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utilizatori';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">


    <?= GridView::widget(['dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'type_id',
                'value' => function ($data) {
                    if ($data->type_id == DictionaryDetail::DOCTOR) {
                        return 'Medic';
                    } elseif ($data->type_id == DictionaryDetail::MEDICAL_ASSISTANT) {
                        return 'Asistent Medical';
                    } else {
                        return 'Admin';
                    }
                },
                'filter' => ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::USER_TYPE])->all(), 'Id', 'Name'),
            ],
            [
                'attribute' => 'section',
                'value' => function ($data) {
                    $string = '';
                    foreach($data->getUserXSections()->all() as $section){
                        $string .= $section->getSection()->One()->Name . ', ';
                    }
                    return $string;
                },
				'contentOptions'=>['style'=>'max-width: 150px;overflow-x:hidden;'],
                'filter' => ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::SECTION])->all(), 'Id', 'Name'),
            ],
            'username',
            'email:email',

            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-info"></span>', ['user/view', 'id' => $data->Id], ['title' => 'Vizualizați utilizator']);
                    },
                    'update' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-note"></span>', ['user/update', 'id' => $data->Id], ['title' => 'Modificați utilizator']);
                    },
                    'delete' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-ban"></span>', ['user/delete', 'id' => $data->Id], ['aria-label'=>'delete', 'data-confirm'=>'Sunteți siguri că doriți să ștergeți acest obiect?', 'data-method'=>'post', 'data-pjax'=>'0', 'title' => 'Ștergeți utilizator']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
