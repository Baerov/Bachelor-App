<?php

use yii\db\Migration;

class m160923_093855_dictionary extends Migration
{
    public function up()
    {
        $this->insert('Dictionary',array(
            'Name'=>'User Type',
            'created_at'=>time(),
            'updated_at'=>time(),
        ));
        $this->insert('Dictionary',array(
            'Name'=>'Patient Status',
            'created_at'=>time(),
            'updated_at'=>time(),
        ));
        $this->insert('Dictionary',array(
            'Name'=>'Internment Status',
            'created_at'=>time(),
            'updated_at'=>time(),
        ));
        $this->insert('DictionaryDetail',array(
            'DictionaryId'=>1,
            'Name'=>'Admin',
            'Code'=>'AN',
            'created_at'=>time(),
            'updated_at'=>time(),
        ));
        $this->insert('DictionaryDetail',array(
            'DictionaryId'=>1,
            'Name'=>'Doctor',
            'Code'=>'DO',
            'created_at'=>time(),
            'updated_at'=>time(),
        ));
        $this->insert('DictionaryDetail',array(
            'DictionaryId'=>1,
            'Name'=>'Medical Assistant',
            'Code'=>'MA',
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
