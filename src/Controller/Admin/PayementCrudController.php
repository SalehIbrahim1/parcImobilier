<?php

namespace App\Controller\Admin;

use App\Entity\Payement;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class PayementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Payement::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            DateField::new('payer_le'),
            NumberField::new('montant'),
            AssociationField::new("contrat")
        ];
    }
    
}
