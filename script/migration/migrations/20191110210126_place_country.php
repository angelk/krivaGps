<?php

use Phinx\Migration\AbstractMigration;

class PlaceCountry extends AbstractMigration
{
    public function up()
    {
        $this->query("
            ALTER TABLE place
                ADD country_id VARCHAR(2) NULL;

            ALTER TABLE place
                ADD constraint place_country_id_fk
                FOREIGN KEY (country_id) REFERENCES country (id);
        ");
    }

    public function down()
    {
        $this->query("
            ALTER TABLE place
                DROP FOREIGN KEY place_country_id_fk;

            ALTER TABLE place
                DROP COLUMN country_id;
        ");
    }
}
