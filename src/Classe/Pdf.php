<?php

namespace App\Classe;

use App\Entity\Commande;
use App\Entity\CommandeDetails;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Twig\Environment;

class Pdf
{
    private $em;
    private $twig;
    public function __construct(EntityManagerInterface $em, Environment $twig)
    {
        $this->em = $em;
        $this->twig = $twig;
    }
    public function genererFacture($commandeDetails): string
    {

        $dompdf = new Dompdf();

        // Chemin vers l'image
        $image_path = '../public/assets/images/logo.svg';

        // Lit le contenu du fichier
        $image_data = file_get_contents($image_path);

        // Convertit en base64
        $base64_image = base64_encode($image_data);

        $html = $this->twig->render('compte/facture.html.twig', [
            'details' => $commandeDetails,
            'base64_image' => $base64_image  // Passer la variable base64_image à Twig
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->getOptions()->setIsPhpEnabled(true);
        $dompdf->render();

        return $dompdf->output();
    }

    public function genererpreparation($commandePayees): string
    {
         // Chemin vers l'image
         $image_path = '../public/assets/images/logo.svg';

         // Lit le contenu du fichier
         $image_data = file_get_contents($image_path);
 
         // Convertit en base64
         $base64_image = base64_encode($image_data);


        $dompdf = new Dompdf();
    
        // Rendez votre vue Twig en PDF
        $html = $this->twig->render('preparation/print.html.twig', [
            'detail' => $commandePayees,
            'base64_image' => $base64_image  // Passer la variable base64_image à Twig
        ]);
    
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->getOptions()->setIsPhpEnabled(true);
        $dompdf->render();

        return $dompdf->output();
    }
    
    
}
