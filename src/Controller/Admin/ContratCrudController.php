<?php

namespace App\Controller\Admin;

use App\Entity\Contrat;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContratCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contrat::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('locataire'),
            IdField::new('id')->hideOnForm(),
            DateField::new('date_debut'),
            DateField::new('date_fin'),
            NumberField::new('loyer_principale'),
            NumberField::new('cautionnement'),
            NumberField::new('charge'),
            NumberField::new('frais_timbre'),
            NumberField::new('frais_enregistrement'),
            NumberField::new('tva'),
            NumberField::new('total')->onlyOnIndex(),
            NumberField::new('payer')->onlyOnIndex(),
            NumberField::new('reste')->onlyOnIndex(),
        ];
    }
    
    public function configureActions(Actions $actions): Actions
    {
        $action = Action::new("Faire un payement");
        $action->linkToRoute("app_contrat_paye",function (Contrat $contrat){
            return[
                'id'=>$contrat->getId()
            ];
        });

        return $actions
            // ...
           // ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_INDEX,$action)
            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER);
    }
}
