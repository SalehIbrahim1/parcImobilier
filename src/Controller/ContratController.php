<?php

namespace App\Controller;

use App\Controller\Admin\ContratCrudController;
use App\Entity\Contrat;
use App\Entity\Payement;
use App\Form\PayementType;
use Doctrine\Persistence\ManagerRegistry;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContratController extends AbstractController
{
    private $managaer;
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managaer = $managerRegistry->getManager();
    }
    #[Route('/contrat-{id}/paye', name: 'app_contrat_paye')]
    public function addPayement(Contrat $contrat = null, Request $request, AdminUrlGenerator $adminUrlGenerator): Response
    {
        //dd($contrat);
        $payement = new Payement();
        $payement->setContrat($contrat);
        $form = $this->createForm(PayementType::class, $payement);
        $form->get('montant')->setData($contrat->getReste());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //dd($payement);
            if ($payement->getMontant() > $contrat->getReste()) {
                //dd('d');
                $m = $contrat->getReste();
                $this->addFlash('error', "le montant ne doit pas depasser $m");
            } else {
                $payement->setPayerLe(new \DateTimeImmutable());
                $this->managaer->persist($payement);
                $this->managaer->flush();
                $this->addFlash('success', "Payement effectuer");
                $url = $adminUrlGenerator
                    ->setController(ContratCrudController::class)
                    ->setAction(Crud::PAGE_INDEX)
                    ->generateUrl();
                return $this->redirect($url);
            }
        }
        return $this->render('contrat/index.html.twig', [
            'form' => $form->createView(),
            'contrat' => $contrat
        ]);
    }
}
