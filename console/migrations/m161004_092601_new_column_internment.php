<?php

use yii\db\Migration;

class m161004_092601_new_column_internment extends Migration
{
    public function up()
    {
        $this->addColumn('Internment','PatientId', $this->integer());
        $this->addForeignKey('internments_patient_id', 'Internment', 'PatientId', 'Patient', 'Id');
    }

    public function down()
    {
        $this->dropForeignKey('internments_patient_id', 'Internment');
        $this->dropColumn('Internment','PatientId');
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
