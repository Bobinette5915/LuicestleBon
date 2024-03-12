<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Classe\Preparation;
use App\Form\StripeFormType;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Stripe;
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

    public function index(Cart $cart, Preparation $preparation, Request $request): Response
    {
        $idUtilisateur = $this->getUser()->getId();
        $dateJour = new \DateTime();
        
        // Créez votre formulaire ici
        $form = $this->createForm(StripeFormType::class);

        // Gérez la soumission du formulaire
        $form->handleRequest($request);
        $idCommande = null;
        if ($form->isSubmitted() && $form->isValid()) {
             // Récupérer les données du formulaire
            $formData = $form->getData();
            $idCommande = $formData['idCommande'];
            // dd($idCommande);
            
            return $this->redirectToRoute('payment_stripe', ['idCommande'=> $idCommande]);

        }

        // dd($preparation->get(), $cart->get());
        return $this->render('recapitulatif/index.html.twig', [
            'date' => $dateJour,
            'cart' => $cart->get(),
            'preparation' => $preparation->get(),
            'form' => $form->createView(),
            'idCommande' => $idCommande,
        ]);
    }
    
    #[Route('/recapitulatif/remove', name: 'app_remove_preparation')]
    public function remove(Preparation $preparation): Response
    {

        $preparation->remove();

        return $this->redirectToRoute('app_remove_cart');
    }
}