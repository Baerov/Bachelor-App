<?php

use yii\db\Migration;

class m161214_084626_patient_request extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('PatientRequest', [
            'Id' => $this->primaryKey(),
            'UserId' => $this->integer()->notNull(),
            'PatientId' => $this->integer()->notNull(),
            'RecallDate' => $this->dateTime(),
        ], $tableOptions);
        

    }

    public function down()
    {

        
        $this->dropTable('PatientRequest');
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
