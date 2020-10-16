<?php
namespace backend\behaviors;


use backend\models\DictionaryDetail;
use backend\models\User;
use backend\models\UserXSection;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

class UserBehavior extends AttributeBehavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
        ];
    }

    /**
     * @param $event
     */
    public function beforeValidate($event)
    {
        if($this->getOwner()->isNewRecord){
            $this->getOwner()->generateAuthKey();
            $this->getOwner()->password_hash = Yii::$app->getSecurity()->generatePasswordHash($this->getOwner()->password_hash);
        }
    }

    /**
     * @return User
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
        if ($this->getOwner()->type_id == DictionaryDetail::ADMIN) {
            $auth = Yii::$app->authManager;
            $adminRole = $auth->getRole('administrator');
            $auth->assign($adminRole, $this->getOwner()->getId());
        }
        if ($this->getOwner()->type_id == DictionaryDetail::DOCTOR) {
            $auth = Yii::$app->authManager;
            $operatorRole = $auth->getRole('doctor');
            $auth->assign($operatorRole, $this->getOwner()->getId());
        }
        if ($this->getOwner()->type_id == DictionaryDetail::MEDICAL_ASSISTANT) {
            $auth = Yii::$app->authManager;
            $agentRole = $auth->getRole('medical_assistant');
            $auth->assign($agentRole, $this->getOwner()->getId());
        }
    }

    public function afterUpdate($event)
    {
        if(isset($this->getOwner()->section) && !empty($this->getOwner()->section)){
            UserXSection::deleteAll(['UserID' => $this->getOwner()->id]);
            foreach ($this->getOwner()->section as $section) {
                $userXSection = new UserXSection();
                $userXSection->UserId = $this->getOwner()->id;
                $userXSection->SectionId = $section;
                $userXSection->save();
            }
        }
    }

}