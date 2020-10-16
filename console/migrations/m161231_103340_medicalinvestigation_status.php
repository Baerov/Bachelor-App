<?php

use yii\db\Migration;

class m161231_103340_medicalinvestigation_status extends Migration
{
    public function up()
    {
        $this->addColumn('MedicalInvestigationXSection','StatusId', $this->integer());
        $this->addForeignKey('MedicalInvestigationXSection_status_id', 'MedicalInvestigationXSection', 'StatusId', 'DictionaryDetail', 'Id');
    }

    public function down()
    {
        $this->dropForeignKey('MedicalInvestigationXSection_status_id', 'MedicalInvestigationXSection');
        $this->dropColumn('MedicalInvestigationXSection','StatusId');
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
