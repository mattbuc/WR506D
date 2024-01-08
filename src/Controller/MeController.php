<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class MeController
{
    /**
     * @Route("/me", name="get_current_user", methods={"GET"})
     */
    public function getCurrentUser(UserInterface $user): JsonResponse
    {
        $userData = [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            // etc....
        ];

        return new JsonResponse($userData);
    }
}