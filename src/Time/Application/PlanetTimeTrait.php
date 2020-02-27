<?php

namespace App\Time\Application;

/**
 * Class PlanetTimeTrait
 *
 * @package App\Time\Application
 */
trait PlanetTimeTrait
{
    /** @var null|string */
    protected $time = null;

    /**
     * @param string $time
     *
     * @return $this
     * @throws \Exception
     */
    public function setSourceTime(string $time)
    {
        if (!$time) {
            throw new \Exception("Invalid source time!");
        }

        $this->time = $time;

        return $this;
    }

    /**
     * @return null|string
     * @throws \Exception
     */
    public function getSourceTime(): ?string
    {
        if (!$this->time) {
            throw new \Exception("Missing source time!");
        }

        return $this->time ?? null;
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    public function isIso(string $value)
    {
        if (!is_string($value) || !$value) {
            return false;
        }

        $dateTime = \DateTime::createFromFormat(\DateTime::ISO8601, $value);

        if ($dateTime) {
            return $dateTime->format(\DateTime::ISO8601) === $value;
        }

        return false;
    }

    /**
     * @param string $time
     *
     * @return int
     * @throws \Exception
     */
    public function toMilliseconds(string $time): int
    {
        if (!$time) {
            throw new \Exception("Invalid source time!");
        }

        $toUnix = date("U", strtotime($time));

        return round($toUnix * 1000);
    }
}