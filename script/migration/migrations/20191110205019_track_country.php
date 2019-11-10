<?php

use Phinx\Migration\AbstractMigration;

class TrackCountry extends AbstractMigration
{
    public function up()
    {
        $this->query("
            ALTER TABLE track
                ADD country_id VARCHAR(2) NULL;

            ALTER TABLE track
                ADD constraint track_country_id_fk
                FOREIGN KEY (country_id) REFERENCES country (id);
        ");
    }

    public function down()
    {
        $this->query("
            ALTER TABLE track
                DROP FOREIGN KEY track_country_id_fk;

            ALTER TABLE track
                DROP COLUMN country_id;
        ");
    }
}
