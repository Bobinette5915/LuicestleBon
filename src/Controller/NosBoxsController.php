<?php

namespace App\Controller;

use App\Entity\Boxs;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NosBoxsController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }


    #[Route('/nos-Boxs', name: 'app_boxs')]
    public function index(): Response
    {
        $Boxs = $this->entityManager->getRepository(Boxs::class)->findAll();
        

        return $this->render('nos_boxs/index.html.twig', [
            'Boxs' => $Boxs,
        ]);
    }
}