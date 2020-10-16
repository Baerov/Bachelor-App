<?php

use backend\models\Dictionary;
use backend\models\DictionaryDetail;
use backend\models\Internment;
use backend\models\MedicalInvestigation;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\search\MedicalinvestigationXSectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cereri investigație medicale';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="medicalinvestigation-xsection-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model){
            $setDate = new DateTime(date('Y:m:d h:i:s', $model->created_at));
            $now = new DateTime(date('Y:m:d h:i:s', time()));
            if($model->StatusId == DictionaryDetail::GENERAL_STATUS_NEW && $setDate < $now) {
                return ['class'=>'danger'];
            }
            else{
                return '';
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'UserId',
                'value' => function ($data) {
                    return $data->getUser()->one()->username;
                },
                'visible' => Yii::$app->user->can('addPatient')
            ],
            [
                'attribute' => 'MedicalInvestigationId',
                'value' => function ($data) {
                    return $data->getMedicalInvestigation()->one()->Name;
                },
                'filter' => ArrayHelper::map(MedicalInvestigation::find()->all(), 'Id', 'Name'),
            ],
            [
                'attribute' => 'SectionId',
                'format'=>'raw',
                'value' => function ($data) {
                    return $data->getSection()->one()->Name;
                },
				'contentOptions'=>['style'=>'max-width: 150px;overflow-x:hidden;'],
            ],
            [
                'attribute' => 'InternmentId',
                'format'=>'raw',
                'value' => function ($data) {
                    return Html::a('Internare #'.$data->getInternment()->one()->Id, ['internment/view', 'id'=>$data->getInternment()->one()->Id]);
                },
                'filter' => Yii::$app->user->identity->type_id == DictionaryDetail::MEDICAL_ASSISTANT ? ArrayHelper::map(Internment::findBySql('SELECT i.Id FROM Internment i INNER JOIN MedicalInvestigationXSection x ON x.InternmentId = i.Id WHERE i.MedicalAssistantId = :user_id AND i.Enabled=1 AND x.Enabled=1', ['user_id'=>Yii::$app->user->identity->getId()])->all(), 'Id', 'Id') : ArrayHelper::map(Internment::find()->all(), 'Id', 'Id')
                ,
            ],
            [
                'attribute' => 'StatusId',
                'value' => function ($data) {
                    return $data->getStatus()->one()->Name;
                },
                'filter' => ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId'=>Dictionary::GENERAL_STATUS])->all(), 'Id', 'Name'),
            ],
            'created_at:datetime',

            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-info"></span>', ['medical-investigation-x-section/view', 'id' => $data->Id], ['title' => 'Vizualizați cerere investigație medicală']);
                    },
                    'update' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-note"></span>', ['medical-investigation-x-section/update', 'id' => $data->Id], ['title' => 'Modificați cerere investigație medicală']);
                    },
                    'delete' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-ban"></span>', ['medical-investigation-x-section/delete', 'id' => $data->Id], ['aria-label'=>'delete', 'data-confirm'=>'Sunteți siguri că doriți să ștergeți acest obiect?', 'data-method'=>'post', 'data-pjax'=>'0', 'title' => 'Ștergeți cerere investigație medicală']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
