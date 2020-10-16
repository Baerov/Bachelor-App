<?php

namespace console\controllers;

use backend\models\Appointment;
use Yii;
use yii\console\Controller;
use yii\helpers\Url;

/**
 * Cron controller
 */
class CronController extends Controller {

    public function actionIndex() {
        $model = Appointment::find()->where(['Notification'=>0])->andWhere(['>', 'Date', date('Y-m-d', strtotime('+1 day'))])->all();
        /** @var Appointment $notification */
        foreach($model as $notification){
                $email = $notification->getAgent()->one()->email;
                $contact= $notification->getContact()->one()->Name;
                $link = Url::to(['internment/view', 'id'=>$notification->Id]);
                $body = <<<HTML
<h4>Appointment reminder</h4>
<p>You have an internment with the patient: {$contact} set at the date {$notification->Date}</p>
<p>Link to internment: <a href="{$link}">Appointment</a></p>
HTML;
                Yii::$app->mailer->compose()
                    ->setTo($email)
                    ->setFrom([Yii::$app->params['systemEmail']['email'] => Yii::$app->params['systemEmail']['name']])
                    ->setSubject('Appointment reminder')
                    ->setHtmlBody($body)
                    ->send();
            $notification->Notification = 1;
            $notification->save();
            }
    }
}