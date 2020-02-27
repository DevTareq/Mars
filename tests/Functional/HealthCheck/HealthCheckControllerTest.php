<?php

namespace App\Tests\HealthCheck;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class HealthCheckControllerTest
 *
 * @package App\Test
 */
class HealthCheckControllerTest extends WebTestCase
{
    /** @test */
    public function itReturns200StatusCode()
    {
        $client = $this->createClient();

        $client->request(
            'GET',
            '/time/health-check'
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}