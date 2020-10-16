<?php

use yii\db\Migration;

class m161006_102815_extra_state_id_column extends Migration
{
    public function up()
    {
        $this->addColumn('Internment', 'ExtraStatus', $this->integer());
        $this->addForeignKey('internment_extra_status', 'Internment', 'ExtraStatus', 'DictionaryDetail', 'Id');
    }

    public function down()
    {
        $this->dropColumn('Internment', 'ExtraStatus');
        $this->dropForeignKey('internment_extra_status', 'Internment');
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
