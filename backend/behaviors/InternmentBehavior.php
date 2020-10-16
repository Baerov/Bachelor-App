<?php
namespace backend\behaviors;


use backend\models\Intern;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;

class InternmentBehavior extends AttributeBehavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
        ];
    }

    /**
     * @return Internment
     */
    private function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param $event
     */
    public function afterInsert($event)
    {
        $email = $this->getOwner()->getMedicalAssistant()->one()->email;
        $contact= $this->getOwner()->getPatient()->one()->Name;
        $link = Url::to(['internment/view', 'id'=>$this->getOwner()->Id]);
        $body = <<<HTML
<h4>New internment</h4>
<p>You have an new internment with the patient: {$contact} set at the date {$this->getOwner()->Date}</p>
<p>Link to internment: <a href="{$link}">Internment</a></p>
HTML;
        Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['systemEmail']['email'] => Yii::$app->params['systemEmail']['name']])
            ->setSubject('New internment')
            ->setHtmlBody($body)
            ->send();
        $this->getOwner()->Notification = 1;
        $this->getOwner()->save();
    }


}