<?php

namespace App\Time\Infrastructure;

use App\Time\Application\PlantTimeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class TimeEndpoint
 *
 * @package App\Time\Infrastructure
 */
class TimeEndpoint extends AbstractController
{
    /** @var PlantTimeInterface string */
    protected $plantTime;

    /**
     * TimeEndpoint constructor.
     *
     * @param PlantTimeInterface $plantTime
     */
    public function __construct(PlantTimeInterface $plantTime)
    {
        $this->plantTime = $plantTime;
    }

    /**
     * @param string $time
     *
     * @return JsonResponse
     */
    public function handle(string $time): JsonResponse
    {
        try {

            $planetTime = $this->plantTime->setSourceTime($time)
                    ->getTiming() ?? [];

            return new JsonResponse($planetTime);

        } catch (\Exception $e) {
            return new JsonResponse($e->getMessage(), 400);
        }
    }
}