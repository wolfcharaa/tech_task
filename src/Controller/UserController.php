<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function __construct(private UserService $service)
    {
    }

    #[Route('/api/{user}/user', methods: Request::METHOD_GET)]
    public function index(User $user): JsonResponse
    {
        return new JsonResponse($user);
    }

    #[Route('/api/user', methods: Request::METHOD_POST)]
    public function createUser(Request $request): JsonResponse
    {
        $this->service->updateOrCreate($request->toArray());

        return new JsonResponse(['message' => 'created successful']);
    }

    #[Route('/api/{user}/user', methods: Request::METHOD_PUT)]
    public function updateUser(Request $request, User $user): JsonResponse
    {
        $this->service->updateOrCreate($request->toArray(), $user);

        return new JsonResponse(['message' => 'updated successful']);
    }
}
