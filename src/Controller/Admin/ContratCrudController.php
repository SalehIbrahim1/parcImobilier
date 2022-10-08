<?php

namespace App\Controller\Admin;

use App\Entity\Contrat;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class ContratCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contrat::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateField::new('date_debut'),
            DateField::new('date_fin'),
            NumberField::new('loyer_principale'),
            NumberField::new('cautionnement'),
            NumberField::new('charge'),
            NumberField::new('frais_timbre'),
            NumberField::new('frais_enregistrement'),
            NumberField::new('tva'),
            AssociationField::new('locataire'),
        ];
    }
    
}
