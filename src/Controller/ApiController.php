<?php

namespace App\Controller;

use App\Repository\TechRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/users', name: 'users')]
    public function users(Request $request, UserRepository $userRepository)
    {
        return $this->json($userRepository->search($request->query->get('q')));
    }

    #[Route('/api/techs', name: 'techs')]
    public function techs(Request $request, TechRepository $techRepository)
    {
        return $this->json($techRepository->search($request->query->get('q')));
    }
}
