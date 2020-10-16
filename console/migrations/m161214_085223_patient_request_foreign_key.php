<?php

use yii\db\Migration;

class m161214_085223_patient_request_foreign_key extends Migration
{
    public function up()
    {
        $this->addForeignKey('patient_request_user_id', 'PatientRequest', 'UserId', 'user', 'id');
        $this->addForeignKey('patient_request_patient_id', 'PatientRequest', 'PatientId', 'Patient', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('patient_request_user_id', 'PatientRequest');
        $this->dropForeignKey('patient_request_patient_id', 'PatientRequest');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
