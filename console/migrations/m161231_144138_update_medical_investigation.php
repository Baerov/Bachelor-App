<?php

use yii\db\Migration;

class m161231_144138_update_medical_investigation extends Migration
{
    public function up()
    {
        $this->addColumn('MedicalInvestigationXSection','InternmentId', $this->integer());
        $this->addForeignKey('MedicalInvestigationXSection_internment_id', 'MedicalInvestigationXSection', 'InternmentId', 'Internment', 'Id');
    }

    public function down()
    {
        $this->dropForeignKey('MedicalInvestigationXSection_internment_id', 'MedicalInvestigationXSection');
        $this->dropColumn('MedicalInvestigationXSection','InternmentId');
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
