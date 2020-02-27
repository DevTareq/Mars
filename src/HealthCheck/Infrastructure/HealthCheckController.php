<?php

namespace App\HealthCheck\Infrastructure;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HealthCheckController
 *
 * @package App
 */
class HealthCheckController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function handle(Request $request): JsonResponse
    {
        return new JsonResponse(["message" => "I am alive!"]);
    }
}