<?php

use yii\db\Migration;

class m161129_143613_fix_patient_information extends Migration
{
    public function up()
    {
        $this->alterColumn('PatientInformation', 'Value', $this->string());
    }

    public function down()
    {
        $this->alterColumn('PatientInformation', 'Value', $this->integer());
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
