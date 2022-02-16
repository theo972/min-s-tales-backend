<?php

namespace App\Controller;



use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class UsersController
{
    /**
     * @Route(path="/users", name="index_users", methods={"GET"})
     */
    public function index(UserRepository $userRepository, Request $request): array
    {

        $user = $userRepository->findAll();

        return $user;
    }

}
