<?php

use yii\db\Migration;

class m161129_105326_interest_tables extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('InterestPoint', [
            'Id' => $this->primaryKey(),
            'CategoryId' => $this->integer()->notNull(),
            'Name' => $this->string()->notNull(),
            'Enabled' => $this->integer()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('InterestPointXPatient', [
            'Id' => $this->primaryKey(),
            'InterestPointId' => $this->integer()->notNull(),
            'PatientId' => $this->integer()->notNull(),
            'Enabled' => $this->integer()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('InterestPoint_category_id', 'InterestPoint', 'CategoryId', 'DictionaryDetail', 'Id');
        $this->addForeignKey('InterestPointXPatient_point_id', 'InterestPointXPatient', 'InterestPointId', 'InterestPoint', 'Id');
        $this->addForeignKey('InterestPointXPatient_patient_id', 'InterestPointXPatient', 'PatientId', 'Patient', 'Id');

    }
    public function down()
    {
        $this->dropForeignKey('InterestPoint_category_id', 'InterestPoint');
        $this->dropForeignKey('InterestPointXPatient_point_id', 'InterestPointXPatient');
        $this->dropForeignKey('InterestPointXPatient_patient_id', 'InterestPointXPatient');
        
        $this->dropTable('InterestPoint');
        $this->dropTable('InterestPointXPatient');


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
