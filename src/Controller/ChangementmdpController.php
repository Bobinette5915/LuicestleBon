<?php

namespace App\Controller;

use App\Form\ChangementmdpType;
use App\Form\ChangepasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Classe\Mail;

class ChangementmdpController extends AbstractController
{
    #[Route('/compte/modifier-mon-mot-de-passe', name: 'app_changementmdp')]

    #[Route('/inscription', name: 'app_inscription')]
    
    public function index(Request $request,EntityManagerInterface $entityManager, UserPasswordHasherInterface $encoder): Response  
        {

        $notification = null;

        $user = $this->getUser();
        $form=$this->createForm(ChangementmdpType::class,$user);

        $form->handleRequest($request);
    // dd($user);
        if ($form->isSubmitted() && $form->isValid()) {
            $old_pwd = $form->get('old_password')->getData();
            
            
            if ($encoder->isPasswordValid($user, $old_pwd)) {               
                $new_pwd=$form->get('new_password')->getData();
                $password = $encoder->hashPassword($user, $new_pwd);

                $user->setPassword($password);
                
                $entityManager->flush();
                $notification = "Votre mot de passe a été correctement modifié. <br> Un email vient de vous être envoyé";

                // envoi du mail de confirmation de changement de mdp
                $mail =new mail();
                $objet = 'Bienvenue sur "Les Brunchs"';
                $contenue = 'Bonjour '.$user->getNom().' <br>Bienvenue sur "les Brunchs de Bob et Tintin", <br> Votre changement de mot de passe a bien été enregistrée ! Vous pouvez dès à present vous connecter <br><hr><br>Decouvrez nos Boxs et mettez du soleil dans vos petits dejeunées !!';
                $mail -> send('lesbrunchsdebt@gmail.com', 'Les Brunchs destinataire', $user->getEmail(), $user->getNom(),  $objet, $contenue);

            }else {
            $notification = "Votre mot de passe actuel n'est pas le bon";
        }
    }

        return $this->render('/compte/motdepasse.html.twig',[
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
