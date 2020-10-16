<?php

use yii\db\Migration;

class m161214_093131_patient_request_created_at extends Migration
{
    public function up()
    {
        $this->addColumn('PatientRequest', 'created_at', $this->integer()->notNull());
        $this->addColumn('PatientRequest', 'updated_at', $this->integer()->notNull());
    }

    public function down()
    {
        $this->dropColumn('PatientRequest', 'created_at');
        $this->dropColumn('PatientRequest', 'updated_at');
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
