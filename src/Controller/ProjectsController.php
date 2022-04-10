<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController
{
    #[Route('/projects', name: 'projects')]
    public function index(ProjectRepository $projectRepository): Response
    {
        return $this->render('projects/index.html.twig', [
            'projects'=>$projectRepository->findAll(),
        ]);
    }

    #[Route('/projects/{id}', name: 'project')]
    public function show($id, ProjectRepository  $projectRepository): Response
    {
        return $this->render('projects/show.html.twig', [
            'project'=> $projectRepository->find($id)
        ]);
    }
}
