<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Boxs;
use App\Entity\Commande;
use App\Entity\CommandeDetails;
use App\Entity\Ingredients;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MescommandesController extends AbstractController
{  

    #[Route('/compte/mescommandes', name: 'app_mescommandes')]
    public function index(Cart $cart, EntityManagerInterface $entityManager): Response
    {
        
        $idUtilisateur = $this->getUser()->getId();

        $commande = $entityManager->getRepository(Commande::class)->findby([
            'idUtilisateur' => $idUtilisateur,
        ]);
        
        $commandeDetails = $entityManager->getRepository(CommandeDetails::class)->findAll();
        $boxs = $entityManager->getRepository(Boxs::class)->findAll();
        $details = [];
        foreach ($commande as $detail) {
            $details[] = $detail->getCommandeDetails()->getValues();
        }

        // Fonction  pour trier les détails de commande par dateLivraison
        usort($details, function($a, $b) {
            return $b[0]->getCommande()->getDateCommande() <=> $a[0]->getCommande()->getDateCommande();
        });

        return $this->render('compte/Mescommandes.html.twig', [
            'commande' => $commande,
            'details' => $details,
            'boxs' => $boxs,
        ]);
    }
}
