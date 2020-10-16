<?php

namespace backend\controllers;

use backend\models\Internment;
use backend\models\DictionaryDetail;
use backend\search\InternmentSearch;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * DictionaryDetailController implements the CRUD actions for DictionaryDetail model.
 */
class CalendarController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'jsoncalendar'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionJsoncalendar($start = NULL, $end = NULL, $_ = NULL)
    {
        if (Yii::$app->user->identity->type_id == DictionaryDetail::ADMIN) {
            $times = Internment::find()->all();
        }
        if (Yii::$app->user->identity->type_id == DictionaryDetail::DOCTOR) {

            $times = Internment::find()->where(['DoctorId' => Yii::$app->user->identity->id])->all();
        }
        if (Yii::$app->user->identity->type_id == DictionaryDetail::MEDICAL_ASSISTANT) {

            $times = Internment::find()->where(['MedicalAssistantId' => Yii::$app->user->identity->id])->all();
        }
        $events = array();

        foreach ($times AS $time) {
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $time->Id;
            $Event->title = 'Internare # ' . $time->Id;
            $Event->description = $time->Comment;
            $Event->url = Url::to(['internment/view', 'id' => $time->Id]);
            $Event->start = date('Y-m-d\TH:i:s\Z', strtotime($time->Date));
            $Event->end = date('Y-m-d\TH:i:s\Z', strtotime('+1 hour', strtotime($time->Date)));
//            $Event->end = Yii::$app->formatter->asDatetime(strtotime($time->Date, '+1 hour'), 'php:Y-m-d\Th:i:s\Z');
            $events[] = $Event;
        }

        header('Content-type: application/json');
        echo Json::encode($events);
        Yii::$app->end();
    }

    public function actionIndex()
    {
        if(!Internment::getAccess() && Yii::$app->user->identity->type_id == DictionaryDetail::MEDICAL_ASSISTANT){
            return $this->redirect(['site/index']);
        }
        return $this->render('index');
    }

}