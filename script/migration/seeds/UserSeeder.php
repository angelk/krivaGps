<?php

use Phinx\Seed\AbstractSeed;
use Symfony\Component\Console\Output\OutputInterface;

class UserSeeder extends AbstractSeed
{
    /* How many users to generate */
    const USER_COUNT = 30;

    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];

        /* Delete previous data */
        $this->query("UPDATE track_file SET version_id = NULL");
        $this->query("UPDATE version SET file_id = NULL");
        $this->query("DELETE FROM track_slug");
        $this->query("DELETE FROM track_file");
        $this->query("DELETE FROM track_image");
        $this->query("DELETE FROM version_waypoint");
        $this->query("DELETE FROM point");
        $this->query("DELETE FROM optimized_point");
        $this->query("DELETE FROM version");
        $this->query("DELETE FROM track");
        $this->query("DELETE FROM user");
        $this->query("ALTER TABLE user AUTO_INCREMENT = 1");

        for ($i = 0; $i < self::USER_COUNT; $i++) {
            $username = $faker->firstName . ' ' . $faker->lastName;
            $email = $faker->email;
            $this->getOutput()->writeln("Generating: {$username}", OutputInterface::VERBOSITY_VERY_VERBOSE);
            $data[] = [
                'username' => $username,
                'username_canonical' => mb_convert_case($username, MB_CASE_LOWER, "UTF-8"),
                'email' => $email,
                'email_canonical' => mb_convert_case($email, MB_CASE_LOWER, "UTF-8"),
                'enabled' => true,
                'password' => sha1(base64_encode(random_bytes(30))),
                'facebook_id' => random_int(1e17, 1e18),
                'roles' => "a:0:{}",
                'terms_accepted' => date('Y-m-d H:i:s')
            ];
        }

        $this->table('user')->insert($data)->save();
    }
}
