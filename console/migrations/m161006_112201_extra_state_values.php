<?php

use backend\models\Dictionary;
use yii\db\Migration;

class m161006_112201_extra_state_values extends Migration
{
    public function up()
    {
        $this->insert('Dictionary',array(
            'Name'=>'Internment Extra Status',
            'created_at'=>time(),
            'updated_at'=>time(),
        ));
        $this->insert('DictionaryDetail',array(
            'DictionaryId'=> Dictionary::EXTRA_STATUS,
            'Name'=>'Active',
            'Code'=>'ACTIVE',
            'created_at'=>time(),
            'updated_at'=>time(),
        ));
        $this->insert('DictionaryDetail',array(
            'DictionaryId'=> Dictionary::EXTRA_STATUS,
            'Name'=>'Inactive',
            'Code'=>'INACTIVE',
            'created_at'=>time(),
            'updated_at'=>time(),
        ));
    }

    public function down()
    {
        
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
