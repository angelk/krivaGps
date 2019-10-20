<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrackTest extends WebTestCase
{
    public function testViewTrack()
    {
        $client = static::createClient();

        $client->request('GET', '/en/gps/view/24h_2019');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}