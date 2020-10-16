<?php

use yii\db\Migration;

class m160923_140704_dictionary_section_city extends Migration
{
    public function up()
    {
        $this->insert('Dictionary',array(
            'Name'=>'Section',
            'created_at'=>time(),
            'updated_at'=>time(),
        ));
        $this->insert('Dictionary',array(
            'Name'=>'City',
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
