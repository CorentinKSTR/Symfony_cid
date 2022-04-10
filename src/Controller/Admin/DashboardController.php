<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Entity\Tech;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {

    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(UserCrudController::class)
            ->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('DevLab - Envie de Crever');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Users');

        yield MenuItem::subMenu('Users', 'fas fa-user')->setSubItems([
            MenuItem::linkToCrud('Show Users', 'fas fa-eye', User::class)
        ]);

        yield MenuItem::section('Projects');

        yield MenuItem::subMenu('Projects', 'fas fa-folder')->setSubItems([
            MenuItem::linkToCrud('Create Project', 'fas fa-plus', Project::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Projects', 'fas fa-eye', Project::class)
        ]);

        yield MenuItem::section('Tech');

        yield MenuItem::subMenu('Tech', 'fas fa-microchip')->setSubItems([
            MenuItem::linkToCrud('Create Tech', 'fas fa-plus', Tech::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Tech', 'fas fa-eye', Tech::class)
        ]);
    }
}
