<?php

namespace App\Controller;

use App\Classe\Cart;
Use App\Entity\User;
use App\Entity\Adresse;
use App\Entity\Jours;
use App\Entity\Heures;
use App\Form\CreneauxType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreneauxController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/compte/creneaux', name: 'app_creneaux')]
    public function index(Cart $cart, Request $request): Response
    {
        if ($cart->get()) {

        $form = $this->createForm(CreneauxType::class, null, [
            'user' => $this->getUser(),
        ]);        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Traitement des données du formulaire si nécessaire
        }


        return $this->render('creneaux/index.html.twig', [
            'cart' => $cart->get(),
            'form' => $form->createView(),
        ]);
    }
    else {
        // Si le panier est vide, vous pouvez rediriger vers une autre page, par exemple
    return $this->redirectToRoute('app_accueil');
    }
    }
}
