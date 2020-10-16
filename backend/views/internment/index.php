<?php

use backend\models\Patient;
use backend\models\Dictionary;
use backend\models\DictionaryDetail;
use backend\models\User;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\search\InternmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Internări';
$this->params['breadcrumbs'][] = $this->title;

$template = '';
if (Yii::$app->user->identity->type_id == DictionaryDetail::ADMIN) {
    $template = '{view}{update}{delete}';
} else {
    $template = '{view}{update}';
}
?>
<div class="internment-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model){
            if($model->ExtraStatus != DictionaryDetail::INTERNMENT_EXTRA_STATUS_ACTIVE) {
                return ['class'=>'danger'];
            }else{
                return null;
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'DoctorId',
                'value' => function ($data) {
                    return $data->getDoctor()->one()->username;
                },
                'filter' => ArrayHelper::map(User::find()->where(['type_id' => DictionaryDetail::DOCTOR])->all(), 'Id', 'username'),
                'visible'=>Yii::$app->user->can('addPatient')
            ],
            [
                'attribute' => 'MedicalAssistantId',
                'value' => function ($data) {
                    return $data->getMedicalAssistant()->one()->username;
                },
                'filter' => ArrayHelper::map(User::find()->where(['type_id' => DictionaryDetail::MEDICAL_ASSISTANT])->all(), 'Id', 'username'),
                'visible'=>Yii::$app->user->can('addPatient')
            ],
            [
                'attribute' => 'PatientId',
                'value' => function ($data) {
                    return $data->getPatient()->one()->Name;
                },
                'filter' => ArrayHelper::map(
                    Patient::findBySql('SELECT p.Id, p.Name FROM Patient p INNER JOIN UserXSection s ON s.SectionId = p.SectionId WHERE p.Enabled = 1 and s.Enabled = 1 and s.UserId = :uid;',
                        ['uid' => Yii::$app->user->getId()])->all(), 'Id', 'Name'),
            ],
            [
                'attribute' => 'Status',
                'value' => function ($data) {
                    return $data->getStatus()->one()->Name;
                },
                'filter' => ArrayHelper::map(DictionaryDetail::find()->where(['DictionaryId' => Dictionary::GENERAL_STATUS])->all(), 'Id', 'Name'),
            ],
            'Date',
            ['class' => 'yii\grid\ActionColumn',
                'template'=> $template,
                'buttons' => [
                    'view' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-info"></span>', ['internment/view', 'id' => $data->Id], ['aria-label'=>'view','title' => 'Vizualizați internare']);
                    },
                    'update' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-note"></span>', ['internment/update', 'id' => $data->Id], ['aria-label'=>'update','title' => 'Modificați internare']);
                    },
                    'delete' => function ($url, $data) {
                        return Html::a('<span class="col-md-3 icon-ban"></span>', ['internment/delete', 'id' => $data->Id], ['aria-label'=>'delete', 'data-confirm'=>'Sunteți siguri că doriți să ștergeți acest obiect?', 'data-method'=>'post', 'data-pjax'=>'0', 'title' => 'Ștergeți internare']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
