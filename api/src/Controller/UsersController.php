<?php

namespace App\Controller;



use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\UsersService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;


class UsersController extends ApiBaseController
{
    /**
     * @Route(path="/users/register", name="index_users", methods={"Post"})
     */
    public function register(
        UserRepository $userRepository,
        UsersService $usersService,
        UserPasswordHasherInterface $passwordHasher,
        SerializerInterface $serializer,
        Request $request): JsonResponse
    {
        $result = false;
        $user = new User();
        /** @var User $user */
        $user = $serializer->deserialize($request->getContent(), User::class, 'json');

        $hashedPassword = $passwordHasher->hashPassword($user ,$user->getPassword());
        $user->setPassword($hashedPassword);
        $result = $usersService->create($user);

        return $this->json(
            [
                'result' => $result,
            ],
            $result ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }



}
