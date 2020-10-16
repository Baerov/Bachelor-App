<?php

use yii\db\Migration;

class m161012_085124_patient_fix_bulk extends Migration
{
    public function up()
    {
        $this->alterColumn('Patient', 'Information', $this->text());
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
