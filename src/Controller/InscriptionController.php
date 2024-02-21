<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class InscriptionController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/inscription', name: 'app_inscription')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $encoder): Response
    {
        $notification = null;
        $utilisateur = new User();
        $form = $this->createForm(InscriptionType::class, $utilisateur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $utilisateur = $form->getData();
            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($utilisateur->getEmail());

            if (!$search_email) {
                $password = $encoder->hashPassword($utilisateur, $utilisateur->getPassword());
                $utilisateur->setPassword($password);

                $this->entityManager->persist($utilisateur);
                $entityManager->flush();

                $notification = "Votre inscription est validée, un mail vient de vous être envoyé <br>
                Vous pouvez dès à présent vous connecter dans l'onglet  'se Connecter'";

                // envoi du mail de confirmation d'inscription
                // $mail =new mail();
                // $objet = 'Bienvenue sur "Les Brunchs"';
                // $contenue = 'Bonjour '.$utilisateur->getNom().' <br>Bienvenue sur "les Brunchs de Bob et Tintin", <br> Votre inscription a bien été enregistrée ! Vous pouvez dès à present vous connecter <br><hr><br>Decouvrez nos Boxs et mettez du soleil dans vos petits dejeunées !!';
                // $mail -> send('bob.et.tintin@gmail.com', 'Les Brunchs destinataire', $utilisateur->getEmail(), $utilisateur->getNom(),  $objet, $contenue);


            } else {
                $notification = "L'email est déjà pris";
            }
        }

        return $this->render('inscription/index.html.twig',[
            'form' => $form->createView(),
            'controller_name' => 'InscriptionController',
            'notification' => $notification
        ]);
        
    }
}
