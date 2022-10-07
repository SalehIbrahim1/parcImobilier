<?php

namespace App\Controller\Admin;

use App\Entity\Batiment;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class BatimentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Batiment::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('nom'),
            TextField::new('topologie'),
            NumberField::new('surface'),
            AssociationField::new('cite')
            //TextEditorField::new('description'),
        ];
    }
    
}
