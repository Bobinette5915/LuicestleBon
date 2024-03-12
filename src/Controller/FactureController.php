<?php

// src/Controller/FactureController.php

namespace App\Controller;

use App\Classe\Pdf;
use App\Entity\CommandeDetails;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class FactureController extends AbstractController
{
    private $pdf;
    

    public function __construct(Pdf $pdf)
    {
        $this->pdf = $pdf;
    }

    public function genererFacture($id, EntityManagerInterface $entityManager): Response
    {
        // Récupérer les détails de la commande à partir de son identifiant
        $commandeDetails = $entityManager->getRepository(CommandeDetails::class)->findOneBy(['Commande' => $id]);
    
    
        if (!$commandeDetails) {
            throw $this->createNotFoundException('Détails de commande non trouvés');
        }
        
    
        // Maintenant, vous pouvez utiliser $commandeDetails pour générer la facture
        $content = $this->pdf->genererFacture($commandeDetails);
    
        return new Response($content, 200, array(
            'Content-Type' => 'application/pdf'
        ));
    }
    
}

