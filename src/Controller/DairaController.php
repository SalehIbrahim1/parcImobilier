<?php

namespace App\Controller;

use App\Entity\Daira;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DairaController extends AbstractController
{
    #[Route('/daira/{id}', name: 'app_daira_detaille')]
    public function detail(Daira $daira): Response
    {
        return $this->render('daira/detaille.html.twig', [
            'daira' =>$daira,
        ]);
    }
}
