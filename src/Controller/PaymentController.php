<?php

namespace App\Controller;

use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use PharIo\Manifest\Url;
use Stripe\Checkout\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PaymentController extends AbstractController
{
    private $em;
    private $generator;
    public function __construct(EntityManagerInterface $em, UrlGeneratorInterface $generator)
    {
        $this->generator = $generator;
        $this->em = $em;
    }

    #[Route('/recapitulatif/create-session-stripe/{idCommande}', name: 'payment_stripe')]

    public function stripeCheckout($idCommande, EntityManagerInterface $em):RedirectResponse
    {
        
        
        $commande = $this->em->getRepository(Commande::class)->findOneBy(['idCommande'=> $idCommande]);
        
        
        $produitstripe = [
            [
                'price_data' => [
                    'currency' => 'eur', // Assurez-vous d'utiliser la bonne devise
                    'unit_amount' => $commande->getPrix(), // Le montant doit être en cents
                    'product_data' => [
                        'name' => 'Votre Commande des Brunchs de Bob et Tintin', // Par exemple
                    ],
                ],
                'quantity' => 1, // Par exemple
            ]
        ];

        


        // dd($produitstripe); 
        if (!$commande) {
            return $this->redirectToRoute('app_accueil');
        }

    Stripe::setApiKey('sk_test_51Op4WSJmJmRsxkEcYjfpw8NavDgh3us8feaRtDIwKSHpwNKnuAqcVB6vXkiEaxXhiVncqY6hrPousU5PShodhj5400PAah7ViD');

    $checkout_session = Session::create([
        'customer_email'=>$this->getUser()->getEmail(),
        'payment_method_types'=>['card'],
        'line_items' => [
            $produitstripe
        ],
        'mode' => 'payment',
        'success_url' => $this->generator->generate('payment_success',[
            'idCommande'=>$commande->getIdCommande()
        ],UrlGeneratorInterface::ABSOLUTE_URL),
        'cancel_url' => $this->generator->generate('payment_error',[
            'idCommande'=>$commande->getIdCommande()
        ],UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

    return new RedirectResponse($checkout_session->url);

    }

    
    #[Route('/recapitulatif/success/{idCommande}', name: 'payment_success')]

    public function stripeSuccess($idCommande, EntityManagerInterface $em): Response
    {
            $commande = $this->em->getRepository(Commande::class)->findOneBy(['idCommande'=> $idCommande]);
            // Mettre à jour l'attribut isPaid à 1 et le statue en cours de preparation
            $commande->setIsPaid('1');
            $commande->setStatue('En cours de Préparation');
            $this->em->flush();


        return $this->render('recapitulatif/success.html.twig');
    }

    #[Route('/recapitulatif/error/{idCommande}', name: 'payment_error')]

    public function stripeError($idCommande): Response
    {
        return $this->render('recapitulatif/error.html.twig');
    }

}