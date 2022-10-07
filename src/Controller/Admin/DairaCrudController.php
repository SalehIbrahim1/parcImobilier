<?php

namespace App\Controller\Admin;

use App\Entity\Daira;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DairaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Daira::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
