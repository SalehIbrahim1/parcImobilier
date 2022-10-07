<?php

namespace App\Controller\Admin;

use App\Entity\Daira;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DairaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Daira::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('nom'),
            AssociationField::new('communes')->onlyOnDetail(),
        ];
    }

    // public function configureCrud(Crud $crud): Crud
    // {
    //     return $crud
    //         // ...
    //         ->overrideTemplates([
    //             'crud/detail' => 'admin/daira_detail.html.twig',
    //         ]);
    // }

    public function configureActions(Actions $actions): Actions
    {
        $action = Action::new("detail");
        $action->linkToRoute("app_daira_detaille",function (Daira $daira){
            return[
                'id'=>$daira->getId()
            ];
        });

        return $actions
            // ...
           // ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_INDEX,$action)
            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER);
    }
}
