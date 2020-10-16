<?php

use yii\db\Migration;

class m161209_163213_patient_status extends Migration
{
    public function up()
    {
        $this->addColumn('Patient', 'StatusId', $this->integer());
        $this->addForeignKey('patient_status_id', 'Patient', 'StatusId', 'DictionaryDetail', 'Id');
    }

    public function down()
    {
        $this->dropForeignKey('patient_status_id', 'Patient');
        $this->dropColumn('Patient', 'Status');
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
