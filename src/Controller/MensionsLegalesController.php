<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MensionsLegalesController extends AbstractController
{
    #[Route('/mensions-legales', name: 'app_mensions_legales')]
    public function index(): Response
    {
        return $this->render('mensions_legales/index.html.twig', [
            'controller_name' => 'MensionsLegalesController',
        ]);
    }
}
