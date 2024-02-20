<?php

namespace App\Controller;

use App\Entity\Partenaires;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PartenairesController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }


    #[Route('/partenaires', name: 'app_partenaires')]
    public function index(): Response
    {
        $partenaires = $this->entityManager->getRepository(Partenaires::class)->findAll();
        

        return $this->render('partenaires/index.html.twig', [
            'Partenaires' => $partenaires,
        ]);
    }
}