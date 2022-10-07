<?php

namespace App\Controller\Admin;

use App\Entity\Cite;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class CiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cite::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('nom'),
            AssociationField::new('commune'),
        ];
    }
    
}
