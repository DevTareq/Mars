<?php

namespace App\Tests\Infrastructure;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use PHPUnit\Framework\InvalidArgumentException;

/**
 * Class TimeEndpointTest
 *
 * @package App\Tests\Infrastructure
 */
class TimeEndpointTest extends WebTestCase
{
    /** @test */
    public function marsTimeIsRetrievedFromEndpoint()
    {
        $client = $this->createClient();

        $request = $client->request(
            'GET',
            '/time/mars/2020-02-25T10:31:15+0000'
        );

        /** Example in https://en.wikipedia.org/wiki/Timekeeping_on_Mars#Formulas_to_compute_MSD_and_MTC */
        $this->assertJsonStringEqualsJsonString(
            $client->getResponse()->getContent(),
            file_get_contents(__DIR__ . '/Fixtures/response.json')
        );
    }

    /** @test */
    public function marsTimeIsRetrievedFromEndpointDiffDate()
    {
        $client = $this->createClient();

        $request = $client->request(
            'GET',
            '/time/mars/2020-02-29T09:39:10+0000'
        );

        $this->assertJsonStringEqualsJsonString(
            $client->getResponse()->getContent(),
            file_get_contents(__DIR__ . '/Fixtures/response2.json')
        );
    }
}