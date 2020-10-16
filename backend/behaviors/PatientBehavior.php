<?php
namespace backend\behaviors;


use backend\models\Patient;
use backend\models\DictionaryDetail;
use backend\models\InterestPointXPatient;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

class PatientBehavior extends AttributeBehavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
        ];
    }

    /**
     * @param $event
     */
    public function beforeValidate($event)
    {
        if (Yii::$app->request->post() && $this->getOwner()->scenario == 'import') {
            $this->getOwner()->load(Yii::$app->request->post());
        }
    }

    public function afterUpdate($event)
    {
        InterestPointXPatient::deleteAll(['PatientId' => $this->getOwner()->Id]);
        if (isset($this->getOwner()->interestPoint)) {
            foreach ($this->getOwner()->interestPoint as $interestPointer) {
                $interestPointXPatient = new InterestPointXPatient();
                $interestPointXPatient->PatientId = $this->getOwner()->Id;
                $interestPointXPatient->InterestPointId = $interestPointer;
                $interestPointXPatient->save();

            }
        }
    }

    /**
     * @return Patient
     */
    private function getOwner()
    {
        return $this->owner;
    }
}