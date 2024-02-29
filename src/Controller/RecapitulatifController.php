<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Classe\Preparation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecapitulatifController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/recapitulatif', name: 'app_recapitulatif')]
    public function index(Cart $cart, Preparation $preparation): Response
    {

        
        // dd($preparation->get(), $cart->get());
        return $this->render('recapitulatif/index.html.twig', [
            'cart' => $cart->get(),
            'preparation' => $preparation->get(),
        ]);
    }

    #[Route('/recapitulatif/remove', name: 'app_remove_preparation')]
    public function remove(Preparation $preparation): Response
    {

        $preparation->remove();

        return $this->redirectToRoute('app_accueil');
    }
}
