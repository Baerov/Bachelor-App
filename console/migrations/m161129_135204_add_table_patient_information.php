<?php

use yii\db\Migration;

class m161129_135204_add_table_patient_information extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('PatientInformation', [
            'Id' => $this->primaryKey(),
            'PatientId' => $this->integer()->notNull(),
            'Name' => $this->string()->notNull(),
            'Value' => $this->integer()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('PatientInformation_patient_id', 'PatientInformation', 'PatientId', 'Patient', 'Id');

    }

    public function down()
    {
        $this->dropForeignKey('PatientInformation_patient_id', 'PatientInformation');
        $this->dropTable('PatientInformation');
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
