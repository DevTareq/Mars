<?php

namespace App\Tests\Domain;

use App\Time\Domain\MarsTime;
use PHPUnit\Framework\TestCase;

/**
 * Class MarsTimeTest
 */
class MarsTimeTest extends TestCase
{
    /** @test */
    public function isValidMsdValue()
    {
        $marsTime = new MarsTime();

        $msd = $marsTime->setSourceTime('2020-02-25T10:31:15+0000')->toMSD();

        $this->assertEquals($msd, 51954.638254182246);
    }

    /** @test */
    public function isValidMtcValue()
    {
        $marsTime = new MarsTime();

        $mtc = $marsTime->setSourceTime('2020-02-25T10:31:15+0000')->toMTC();

        $this->assertEquals($mtc, '15:19:05');
    }
}