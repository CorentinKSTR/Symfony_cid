<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextareaField::new('description'),
            ImageField::new('project_logo')
                ->setBasePath('uploads/projects/projects_logo')
                ->setUploadDir('public/uploads/projects/projects_logo'),
            ImageField::new('project_image')
                ->setBasePath('uploads/projects/projects_image')
                ->setUploadDir('public/uploads/projects/projects_image'),
            AssociationField::new('tech', 'Tech'),
            AssociationField::new('collaborators', 'Collaborators'),
            DateTimeField::new('createdAt')->hideOnForm()->setTimezone('Europe/Paris'),
            AssociationField::new('user')->setDisabled()
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if(!$entityInstance instanceof Project) return;

        $entityInstance->setCreatedAt(new \DateTime());

        parent::persistEntity($entityManager, $entityInstance);
    }
}
