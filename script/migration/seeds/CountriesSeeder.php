<?php


use Phinx\Seed\AbstractSeed;
use Symfony\Component\Console\Output\OutputInterface;

class CountriesSeeder extends AbstractSeed
{
    public function run()
    {
        # Go to data directory
        chdir(__DIR__ . "/data/");

        # Extract archive
        $this->getOutput()->writeln("Extracting data", OutputInterface::VERBOSITY_NORMAL);
        exec("tar -jxf countries.tar.bz2", $output, $ret);
        if ($ret !== 0)
            throw new Exception("Failed to extract data!", $ret);

        # Compare checksum
        $this->getOutput()->writeln("Verify data", OutputInterface::VERBOSITY_NORMAL);
        exec("md5sum -c countries.md5", $output, $ret);
        if ($ret !== 0)
            throw new Exception("Checksum doesn't match!", $ret);

        $countries = json_decode(file_get_contents("countries.json"), true);
        ksort($countries);

        $table = $this->table('countries');

        foreach ($countries as $code => $data) {
            $this->getOutput()->writeln("Processing: {$data['name_en']}", OutputInterface::VERBOSITY_NORMAL);

            $data = [
                'id' => $code,
                'geojson' => json_encode($data['geojson']),
                'name_en' => $data['name_en'],
                'name_bg' => $data['name_bg'],
            ];

            $table->insert($data)->saveData();
        }
    }
}
