<?php

use Phinx\Migration\AbstractMigration;

class Countries extends AbstractMigration
{
    public function up()
    {
        $this->query("
            CREATE TABLE countries (
	            id VARCHAR(64) NOT NULL,
	            geojson JSON NOT NULL,
                name_en VARCHAR(64) NOT NULL,
	            name_bg VARCHAR(64) NOT NULL,	             
		        PRIMARY KEY (id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB
        ");

        $this->query("
            CREATE UNIQUE INDEX countries_name_en_uindex ON countries (name_en);
        ");

        $this->query("
            CREATE UNIQUE INDEX countries_name_bg_uindex ON countries (name_bg);
        ");
    }

    public function down()
    {
        $this->query("DROP TABLE countries");
    }

}
