<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
       $users = $userRepository->findAll();
       return $this->json($users);

    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(UserRepository $userRepository, int $id): Response
    {
        $user = $userRepository->find($id);
        return $this->json($user);
    }

    #[Route('/', name: 'app_user_new', methods: ['POST'])]
    public function new(Request $request, UserRepository $userRepository) : Response
    {
        $data = json_decode($request->getContent(), true);
        $user = new User();
        $user->setUserName($data['userName']);
        $user->setEmailAddress($data['email']);

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->setPassword($hashedPassword);

        $userRepository->save($user, true);
        return $this->json($user);
    }

    #[Route('/{id}', name: 'app_user_edit', methods: ['PATCH'])]
    public function edit(User $user, Request $request, UserRepository $userRepository): Response
    {
        $data = json_decode($request->getContent(), true);
        $user->setUserName($data['userName']);
        $user->setEmailAddress($data['email']);

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->setPassword($hashedPassword);

        $userRepository->save($user, true);
        return $this->json($user);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['DELETE'])]
    public function delete(User $user, UserRepository $userRepository): Response
    {
        $userRepository->remove($user, true);
        return $this->json($user);
    }
}
