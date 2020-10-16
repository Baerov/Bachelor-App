<?php

/* @var $this yii\web\View */
use backend\models\DictionaryDetail;

/* @var $priorityInternmentSearchModel backend\search\InternmentSearch */
/* @var $searchModel backend\search\InternmentSearch */
/* @var $priorityInternmentDataProvider yii\data\ActiveDataProvider */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModelInternment yii\data\ActiveDataProvider */
/* @var $dataProviderInternment yii\data\ActiveDataProvider */
if (Yii::$app->user->identity->type_id == DictionaryDetail::ADMIN) {
    $this->title = 'Index';
} elseif (Yii::$app->user->identity->type_id == DictionaryDetail::DOCTOR) {
    $this->title = 'Pacienți de verificat';
} else {
    $this->title = 'Pacienți de consultat';
}
?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <?php if(Yii::$app->user->identity->type_id == DictionaryDetail::DOCTOR){ ?>
            <?= $this->render('operatorList', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]) ?>
            <?php }else{ ?>
                <?= $this->render('assistantList', [
                    'priorityInternmentSearch' => $priorityInternmentSearchModel,
                    'priorityInternmentDataProvider' => $priorityInternmentDataProvider,
                    'searchModelInternment' => $searchModelInternment,
                    'dataProviderInternment' => $dataProviderInternment,
                ]) ?>
            <?php } ?>
        </div>
    </div>
</div>


