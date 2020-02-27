<?php

namespace App\Tests\Application;

use App\Time\Application\PlantTimeInterface;
use App\Time\Domain\MarsTime;
use PHPUnit\Framework\TestCase;

/**
 * Class PlanetTimeTraitTest
 *
 * @package App\Tests\Application
 */
class PlanetTimeTraitTest extends TestCase
{
    /** @var PlantTimeInterface */
    protected $planet;

    /**
     * Setup planet.
     */
    public function setUp(): void
    {
        $this->planet = (new MarsTime())->setSourceTime('2020-02-25T10:31:15+0000');
    }

    /** @test */
    public function isValidMillisecondsFormat()
    {
        $milli = $this->planet->toMilliseconds($this->planet->getSourceTime());

        $this->assertTrue((string)strlen($milli) == 13);
    }

    /** @test */
    public function isValidIso8601Format()
    {
        $iso8601 = $this->planet->getSourceTime();

        $this->assertTrue($iso8601 == $this->planet->isIso($iso8601));
    }

    /** @test */
    public function isInvalidIso8601Format()
    {
        $this->planet = (new MarsTime())->setSourceTime('2020-02-25T10:31:15');

        $iso8601 = $this->planet->getSourceTime();

        $this->assertFalse($iso8601 == $this->planet->isIso($iso8601));
    }

    /** @test */
    public function missingTimeValue()
    {
        $this->planet = (new MarsTime());

        $this->expectExceptionMessage("Missing source time!");

        $this->planet->getTiming();
    }
}