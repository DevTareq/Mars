<?php

namespace App\Time\Domain;

use App\Time\Application\PlanetTimeTrait;
use App\Time\Application\PlantTimeInterface;

/**
 * Class MarsTime
 *
 * @package App\Time\Domain
 */
class MarsTime implements PlantTimeInterface
{
    use PlanetTimeTrait;

    /** @var int $secondLeap */
    protected $secondLeap = 37;

    /**
     * @return float
     * @throws \Exception
     */
    public function toMSD()
    {
        if (!$this->getSourceTime()) {
            throw new \Exception("Unable to handle time!");
        }

        $time = $this->toMilliseconds($this->getSourceTime());

        $jdUt = 2440587.5 + ($time / 86400000);

        $jdTt = $jdUt + ($this->secondLeap + 32.184) / 86400;

        $j2000 = $jdTt - 2451545.0;

        return ((($j2000 - 4.5) / 1.027491252) + 44796.0 - 0.00096);
    }

    /**
     * @return string
     */
    public function toMTC(): string
    {
        $msd = $this->toMSD();

        $fh = fmod($msd, 1);
        $hh = floor(24 * $fh);

        $tmpFm = 24 * $fh;
        $fm    = abs($tmpFm) - floor(abs($tmpFm));

        $tmpMm = 60 * $fm;
        $mm    = floor($tmpMm);

        $tmpSs = 60 * $fm;
        $ss    = abs($tmpSs) - floor(abs($tmpSs));
        $ss    = floor(60 * $ss);

        if ($hh < 10) {
            $hh = "0" . $hh;
        }

        if ($mm < 10) {
            $mm = "0" . $mm;
        }

        if ($ss < 10) {
            $ss = "0" . $ss;
        }

        return $hh . ":" . $mm . ":" . $ss;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getTiming(): array
    {
        if (!$this->isIso($this->getSourceTime())) {
            throw new \Exception("Wrong Time Format!", 400);
        }

        return [
            "Earth" => [
                "Milli" => $this->toMilliseconds($this->getSourceTime()) ?? ''
            ],
            "Mars"  => [
                "MSD" => $this->toMSD() ?? '',
                "MTC" => $this->toMTC() ?? ''
            ]
        ];
    }
}