<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AjoutadresseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdresseController extends AbstractController
{

        private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    
    #[Route('compte/adresse', name: 'app_adresse')]
    public function index(): Response
    {
        return $this->render('compte/adresse.html.twig');
    }

    #[Route('compte/ajouter-adresse', name: 'app_ajouter_adresse')]
    public function add(Request $request): Response
    {
        $adresse = new Adresse(); 
        $form = $this->createForm(AjoutadresseType::class, $adresse);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $adresse->setUser($this->getUser());
            $this->entityManager->persist($adresse);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_adresse');

        }

        return $this->render('compte/ajouteradresses.html.twig',[
            'form' => $form->createView()
        ]);
    }

    #[Route('compte/supprimer-adresse/{id}', name: 'app_supprimer_adresse')]
    
    
    public function delete($id): Response
    {
        $adresse = $this->entityManager->getRepository(Adresse::class)->findOneById($id);

        if ($adresse && $adresse->getUser() == $this->getUser()) {
            $this->entityManager->remove($adresse);  
            $this->entityManager->flush(); 
        }
            return $this->redirectToRoute('app_adresse');
        
    }
}
