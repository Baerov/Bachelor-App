<?php

use yii\db\Migration;

class m161005_104633_internment_date_comment_columns extends Migration
{
    public function up()
    {
        $this->addColumn('Internment','Date', $this->dateTime());
        $this->addColumn('Internment','Comment', $this->text());
    }

    public function down()
    {
        $this->dropColumn('Internment','Date');
        $this->dropColumn('Internment','Comment');
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
