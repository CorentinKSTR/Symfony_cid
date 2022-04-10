<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProductType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user')]
    public function index(Request $request, EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {
        $project = new Project();
        $form = $this->createForm(ProductType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $project->setUser($this->getUser());
//            $techs = $form->get('collaborators')->getData();
//            dd($techs);
//            foreach ($techs as $tech){
//                $project->addTech($tech);
//            }
            $project = $form->getData();


            $logo = $form->get('project_logo')->getData();
            if($logo){
                $originalFileName = pathinfo($logo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFileName);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$logo->guessExtension();

                $logo->move(
                    $this->getParameter('logo_directory'),
                    $newFilename
                );
                $project->setProjectLogo($newFilename);
            }

            $image = $form->get('project_image')->getData();
            if($image){
                $originalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFileName);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

                $image->move(
                    $this->getParameter('project_directory'),
                    $newFilename
                );
                $project->setProjectImage($newFilename);
            }



            // ... perform some action, such as saving the task to the database

            $manager->persist($project);
            $manager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('user/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
