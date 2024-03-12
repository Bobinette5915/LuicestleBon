<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Resetmdp;
use App\Entity\User;
use App\Form\ResetmdpType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ResetmdpController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }
    
    #[Route('/mot-de-passe-oublie', name: 'app_resetmdp')]
    public function index(Request $request): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_accueil');
        }

        if ($request->get('email')) {
           $utilisateur = $this->em->getRepository(User::class)->findOneBy(['email'=> $request->get('email')]);
          
           if ($utilisateur) {
            $resetmdp = new Resetmdp();
            $resetmdp ->setUser($utilisateur);
            $resetmdp ->setToken(uniqid());
            $resetmdp ->setCreatedAt(new \DateTimeImmutable());
            $this->em->persist($resetmdp);
            $this->em->flush();
            
            // envoi du mail de changement de mot de passe 
            $url = $this->generateUrl('app_updatemdp',[
                'token'=>$resetmdp->getToken()
                ]);

            $mail =new Mail();
            $objet = 'Bienvenue sur "Les Brunchs"';
            $contenue = 'Bonjour '.$utilisateur->getNom().' <br>Bienvenue sur "les Brunchs de Bob et Tintin", <br> Vous avez demander à reinitialiser votre mot de passe<br>Merci de cliquer sur ce lien <a href='.$url.'>pour mettre à jour votre mot de passe</a><hr><br>Decouvrez nos Boxs et mettez du soleil dans vos petits dejeunées !!';
            $mail -> send('lesbrunchsdebt@gmail.com', 'Les Brunchs destinataire', $utilisateur->getEmail(), $utilisateur->getNom(),  $objet, $contenue);

            $this->addFlash('notice','Vous allez recevoir dans quelques secondes un mail pour reinitialiser votre mot de passe');
        }else{
        $this->addFlash('notice','Cette adresse mail ne correspond à aucun compte !');
    }
    }
        return $this->render('resetmdp/index.html.twig');
    }

    #[Route('/modifier-mot-de-passe{token}', name: 'app_updatemdp')]
    public function update(Request $request, $token, UserPasswordHasherInterface $encoder): Response
    {
        $resetmdp = $this->em->getRepository(Resetmdp::class)->findOneBy(['token'=> $token]);

        if (!$resetmdp) {
            return $this->redirectToRoute('app_resetmdp');
        }

        $now = new \DateTimeImmutable();
        if ($now > $resetmdp->getCreatedAt()->modify('+ 2 hour'))
        {
            $this->addFlash('notice','Votre de mande de mot de passe a expiré, merci de la renouveller');
            return $this->redirectToRoute('app_resetmdp');
        }


        $form = $this->createForm(ResetmdpType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $new_pwd = $form->get('new_password')->getData();

            $password = $encoder->hashPassword($resetmdp->getUser(), $new_pwd);
            $resetmdp->getUser()->setPassword($password);

            $this->em->flush();

            $this->addFlash(('notice'), 'Votre mot de passe à bien été mis à jour');
            return $this->redirectToRoute('app_connexion');
    

        }
        return $this->render('resetmdp/updatemdp.html.twig',[
            'form' => $form->createView(),
        ]);

       
    }
}