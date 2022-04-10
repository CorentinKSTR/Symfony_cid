<?php

namespace App\Controller\Admin;

use App\Entity\Tech;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TechCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tech::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            ImageField::new('logo')
                ->setBasePath('uploads/tech_logo')
                ->setUploadDir('public/uploads/tech_logo'),
        ];
    }


}
