<?php

namespace App\Controller;

use App\Entity\Boxs;
use App\Entity\Partenaires;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }

    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {

        $boxs = $this->entityManager->getRepository(Boxs::class)->findAll();
        $partenaires = $this->entityManager->getRepository(Partenaires::class)->findAll();

        // Mélange la liste des partenaires de manière aléatoire
        shuffle($partenaires);
        shuffle($boxs);

        // Sélectionne les  premiers partenaires
        $partenairesAleatoires = array_slice($partenaires, 0, 3);
        $boxAleatoires = array_slice($boxs, 0, 4);

        return $this->render('accueil/index.html.twig', [
            'boxs' => $boxs,
            'boxAleatoires' => $boxAleatoires,
            'partenairesAleatoires' => $partenairesAleatoires,
        ]);
    }
}
