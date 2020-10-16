<?php

use backend\models\Dictionary;
use yii\db\Migration;

class m161007_085133_patient_update extends Migration
{
    public function up()
    {
        $this->addColumn('Patient', 'CategoryId', $this->integer());
        $this->addForeignKey('patient_patient_id', 'Patient', 'CategoryId', 'DictionaryDetail', 'Id');
        $this->insert('Dictionary',array(
            'Name'=>'Patient Category',
            'created_at'=>time(),
            'updated_at'=>time(),
        ));
        $this->insert('DictionaryDetail',array(
            'DictionaryId'=> Dictionary::PATIENT_CATEGORY,
            'Name'=>'Category1',
            'Code'=>'CT1',
            'created_at'=>time(),
            'updated_at'=>time(),
        ));
        $this->insert('DictionaryDetail',array(
            'DictionaryId'=> Dictionary::PATIENT_CATEGORY,
            'Name'=>'Category2',
            'Code'=>'CT2',
            'created_at'=>time(),
            'updated_at'=>time(),
        ));
    }

    public function down()
    {
        $this->dropForeignKey('patient_patient_id', 'Patient');
        $this->dropColumn('Patient', 'PatientId');
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
