<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Classe\Preparation;
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
    public function index(Cart $cart, Request $request, Preparation $preparation, EntityManagerInterface $entityManager): Response
    {
        if ($cart->get()) {

            $user = $this->getUser();

        $form = $this->createForm(CreneauxType::class, null, [
            'user' => $this->getUser(),
        ]); 
        
        $form->handleRequest($request);

        $prixTotal = null;
        // dd($cart->get());
        foreach ($cart->get() as $key => $value) {
            // Vérifiez si la propriété 'id' existe et si elle est un tableau associatif
                if (isset($value['id']) && is_array($value['id'])) {
            // Accédez à la propriété 'box' dans 'id'
                $box = $value['id']['box'];
            // Accédez à la propriété 'Prix' de l'objet Boxs
                $prix = $box->getPrix();
                // on ajoute le prix de la box a la variable prixTotal
                    $prixTotal = $prixTotal + $prix;
                }
        }
        // dd($prixTotal);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $formInfos = $form->getData();
            
            $commande = [
                'idCommande' => uniqid(),
                'idUtilisateur' => $user->getId(),
                'cart' => $cart->get(),
                'infosLivraison' => $formInfos,
                'prix' => $prixTotal,
                
            ];
                
            $preparation->add($commande);

            return $this->redirectToRoute('app_recapitulatif');
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
