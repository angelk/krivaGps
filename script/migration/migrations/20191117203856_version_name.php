<?php

use Phinx\Migration\AbstractMigration;

class VersionName extends AbstractMigration
{
    public function up()
    {
        $this->query("
        ALTER TABLE version 
            CHANGE name name_en VARCHAR(255) NULL;
        ");

        $this->query("
        ALTER TABLE version
	        ADD name_bg VARCHAR(255) NULL;
        ");
    }

    public function down()
    {
        $this->query("
            ALTER TABLE version
                CHANGE name_en name VARCHAR(255) NULL;
        ");

        $this->query("
            ALTER TABLE version
                DROP COLUMN name_bg;
        ");
    }
}
