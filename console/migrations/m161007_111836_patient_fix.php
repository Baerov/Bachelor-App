<?php

use yii\db\Migration;

class m161007_111836_patient_fix extends Migration
{
    public function up()
    {
        $this->addForeignKey('patient_category_id', 'Patient', 'CategoryId', 'DictionaryDetail', 'Id');

    }

    public function down()
    {
        $this->dropForeignKey('patient_category_id', 'Patient');
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
