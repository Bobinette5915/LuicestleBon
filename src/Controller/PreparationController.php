<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Classe\Pdf;
use App\Classe\Preparation;
use App\Entity\Commande;
use App\Entity\CommandeDetails;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Dompdf\Dompdf;

class PreparationController extends AbstractController
{
    
    private $entityManager;
    private $pdf;

    public function __construct(EntityManagerInterface $entityManager, Pdf $pdf)
    {
        $this->entityManager = $entityManager;
        $this->pdf = $pdf;
    }


    #[Route('/preparation', name: 'app_preparation')]
    public function index(Preparation $preparation): Response
    {
        $dateJour = new \DateTime();
        $dateJour->setTime(0, 0, 0);

        $commandeRepository = $this->entityManager->getRepository(Commande::class);
        //trouver uniquement les commandes payées
        $commandesPayees = $commandeRepository->findBy(['isPaid' => true]);
        
        $detail = [];
        foreach ($commandesPayees as $detail) {
            
            $details[] = $detail->getCommandeDetails()->getValues();
        }
    


        // Fonction  pour trier les détails de commande par dateLivraison
        usort($details, function($a, $b) {
            return $a[0]->getCommande()->getDateLivraison() <=> $b[0]->getCommande()->getDateLivraison();
        });

        return $this->render('preparation/index.html.twig', [
            'details' => $details,
            'dateJour' => $dateJour,
            
        
        ]
    );
    }

    #[Route('/preparation/{id}', name: 'app_update')]
    public function update($id, EntityManagerInterface $entityManager):Response
    {
        // Récupérer la commande par son ID
    $commande = $entityManager->getRepository(Commande::class)->find($id);

     // Vérifier si la commande existe
    if (!$commande) {
        throw $this->createNotFoundException('Commande non trouvée pour l\'identifiant ' . $id);
    }

    // Modifier le statut de la commande
    $commande->setStatue('A livrer');

    // Persister les changements dans la base de données
    $entityManager->flush();

     // Rediriger l'utilisateur vers une autre page par exemple
    return $this->redirectToRoute('app_preparation');

    }


    // #[Route("preparation/generatePdfAction/{id}", name:"app_generatePdfAction")]   
    public function genererpreparation(EntityManagerInterface $entityManager, $id): Response
{
    $commandePayees = $entityManager->getRepository(CommandeDetails::class)->findOneBy(['Commande' => $id]);

    if (!$commandePayees) {
        throw $this->createNotFoundException('Détails de commande non trouvés');
    }
    
    $details = $this->pdf->genererpreparation($commandePayees);

    return new Response($details, 200, array(
        'Content-Type' => 'application/pdf'
    ));
}

}
