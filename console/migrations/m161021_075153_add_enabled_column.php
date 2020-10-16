<?php

use yii\db\Migration;

class m161021_075153_add_enabled_column extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'Enabled', $this->integer()->defaultValue(1));
        $this->addColumn('Patient', 'Enabled', $this->integer()->defaultValue(1));
        $this->addColumn('Internment', 'Enabled', $this->integer()->defaultValue(1));
        $this->addColumn('Dictionary', 'Enabled', $this->integer()->defaultValue(1));
        $this->addColumn('UserXSection', 'Enabled', $this->integer()->defaultValue(1));
    }

    public function down()
    {
        $this->dropColumn('user', 'Enabled');
        $this->dropColumn('Patient', 'Enabled');
        $this->dropColumn('Internment', 'Enabled');
        $this->dropColumn('Dictionary', 'Enabled');
        $this->dropColumn('UserXSection', 'Enabled');
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
