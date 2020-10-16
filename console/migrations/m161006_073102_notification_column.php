<?php

use yii\db\Migration;

class m161006_073102_notification_column extends Migration
{
    public function up()
    {
        $this->addColumn('Internment', 'Notification', $this->integer()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('Internment', 'Notification');
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
