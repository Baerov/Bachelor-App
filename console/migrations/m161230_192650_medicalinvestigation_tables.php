<?php

use yii\db\Migration;

class m161230_192650_medicalinvestigation_tables extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('MedicalInvestigation', [
            'Id' => $this->primaryKey(),
            'Name' => $this->string()->notNull(),
            'Enabled' => $this->integer()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('MedicalInvestigationXSection', [
            'Id' => $this->primaryKey(),
            'MedicalInvestigationId' => $this->integer()->notNull(),
            'UserId' => $this->integer()->notNull(),
            'SectionId' => $this->integer()->notNull(),
            'Enabled' => $this->integer()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('MedicalInvestigationXSection_medical_investigation_id', 'MedicalInvestigationXSection', 'MedicalInvestigationId', 'MedicalInvestigation', 'Id');
        $this->addForeignKey('MedicalInvestigationXSection_user_id', 'MedicalInvestigationXSection', 'UserId', 'User', 'id');
        $this->addForeignKey('MedicalInvestigationXSection_section_id', 'MedicalInvestigationXSection', 'SectionId', 'DictionaryDetail', 'Id');

    }

    public function down()
    {
        $this->dropForeignKey('MedicalInvestigationXSection_medical_investigation_id', 'MedicalInvestigationXSection');
        $this->dropForeignKey('MedicalInvestigationXSection_user_id', 'MedicalInvestigationXSection');
        $this->dropForeignKey('MedicalInvestigationXSection_section_id', 'DictionaryDetail');

        $this->dropTable('MedicalInvestigation');
        $this->dropTable('MedicalInvestigationXSection');
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
