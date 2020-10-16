<?php
namespace console\controllers;

use backend\models\DictionaryDetail;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        //PERMISIUNI

        //permisiune adaugare utilizator
        $addUser = $auth->createPermission('addUser');
        $addUser->description = 'Add a user';
        $auth->add($addUser);

        //permisiune adaugare patient
        $addPatient = $auth->createPermission('addPatient');
        $addPatient->description = 'Add a patient';
        $auth->add($addPatient);

        //permisiune adaugare intalnire
        $addInternment = $auth->createPermission('addInternment');
        $addInternment->description = 'Add an internment';
        $auth->add($addInternment);

        //permisiune setare stare intalnire
        $setInternmentStatus = $auth->createPermission('setStatus');
        $setInternmentStatus->description = 'Set internment status';
        $auth->add($setInternmentStatus);

        //ROLURI

        //rol agent
        $medicalAssistant = $auth->createRole('medical_assistant');
        $auth->add($medicalAssistant);
        $auth->addChild($medicalAssistant, $setInternmentStatus);//poate seta statusul internării

        //rol operator
        $doctor = $auth->createRole('doctor');
        $auth->add($doctor);
        $auth->addChild($doctor, $addPatient);//poate adauga patient
        $auth->addChild($doctor, $addInternment);//poate adauga intalnire

        //rol administrator
        $administrator = $auth->createRole('administrator');
        $auth->add($administrator);
        $auth->addChild($administrator, $doctor);//administratorul are permisiunile operatorului
        $auth->addChild($administrator, $medicalAssistant);//administratorul are si permisiunile agentului
        $auth->addChild($administrator, $addUser);//poate asigna utilizator

        //Asignare rol utilizatorilor
        //1, 2 si 3 sunt id-urile returnate de IdentityInterface::getId()
        $auth->assign($medicalAssistant, DictionaryDetail::MEDICAL_ASSISTANT);
        $auth->assign($doctor, DictionaryDetail::DOCTOR);
        $auth->assign($administrator, DictionaryDetail::ADMIN);
    }
}