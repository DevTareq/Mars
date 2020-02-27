<?php

namespace App\HealthCheck\Infrastructure;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @return Response
     */
    public function handle(Request $request): Response
    {
        return new Response('I am alive!');
    }
}