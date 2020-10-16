<?php

use yii\db\Migration;

class m161207_080221_recall_date extends Migration
{
    public function up()
    {
        $this->addColumn('Patient', 'RecallDate', $this->dateTime());
    }

    public function down()
    {
        $this->dropColumn('Patient', 'RecallDate');
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
