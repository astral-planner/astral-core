<?php

declare(strict_types=1);

namespace Astral\Infrastructure\Http\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/api/ping', name: 'ping', methods: ['GET'])]
    public function ping(): Response
    {
        return new JsonResponse();
    }
}
