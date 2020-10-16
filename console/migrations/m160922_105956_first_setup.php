<?php

use yii\db\Migration;

class m160922_105956_first_setup extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%Patient}}', [
            'Id' => $this->primaryKey(),
            'CityId' => $this->integer()->notNull(),
            'SectionId' => $this->integer()->notNull(),
            'Name' => $this->string()->notNull(),
            'Address' => $this->string()->notNull(),
            'Phone' => $this->string(20),
            'MobilePhone' => $this->string(20),
            'Email' => $this->string(),
            'Information' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);


        $this->createTable('{{%Internment}}', [
            
            'Id' => $this->primaryKey(),
            'DoctorId' => $this->integer()->notNull(),
            'MedicalAssistantId' => $this->integer()->notNull(),
            'Status' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%UserXSection}}', [
            'Id' => $this->primaryKey(),
            'UserId' => $this->integer()->notNull(),
            'SectionId' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%Dictionary}}', [
            'Id' => $this->primaryKey(),
            'Name' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%DictionaryDetail}}', [
            'Id' => $this->primaryKey(),
            'Name' => $this->string()->notNull(),
            'Code' => $this->string()->notNull(),
            'Value' => $this->string(),
            'Default' => $this->integer()->notNull()->defaultValue(0),
            'DictionaryId' => $this->integer()->notNull(),
            'Enabled' => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('patient_city_id', 'Patient', 'CityId', 'DictionaryDetail', 'Id');
        $this->addForeignKey('patient_section_id', 'Patient', 'SectionId', 'DictionaryDetail', 'Id');
        $this->addForeignKey('internment_doctor_id', 'Internment', 'DoctorId', 'user', 'id');
        $this->addForeignKey('internment_medical_assistant_id', 'Internment', 'MedicalAssistantId', 'user', 'id');
        $this->addForeignKey('user_x_section_section_id', 'UserXSection', 'SectionId', 'DictionaryDetail', 'Id');
        $this->addForeignKey('user_x_section_user_id', 'UserXSection', 'UserId', 'user', 'id');
        $this->addForeignKey('dictionary_detail_dictionary_id', 'DictionaryDetail', 'DictionaryId', 'Dictionary', 'Id');
        $this->addForeignKey('user_type_id', 'user', 'type_id', 'DictionaryDetail', 'Id');
    }

    public function down()
    {
        $this->dropForeignKey('patient_city_id', 'Patient');
        $this->dropForeignKey('patient_section_id', 'Patient');
        $this->dropForeignKey('internment_doctor_id', 'Internment');
        $this->dropForeignKey('internment_medical_assistant_id', 'Internment');
        $this->dropForeignKey('user_x_section_section_id', 'UserXSection');
        $this->dropForeignKey('user_x_section_user_id', 'UserXSection');
        $this->dropForeignKey('dictionary_detail_dictionary_id', 'DictionaryDetail');
        $this->dropForeignKey('user_type_id', 'user');

        $this->dropTable('{{%Patient}}');
        $this->dropTable('{{%Internment}}');
        $this->dropTable('{{%UserXSection}}');
        $this->dropTable('{{%Dictionary}}');
        $this->dropTable('{{%DictionaryDetail}}');
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
