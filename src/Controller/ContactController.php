<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    { 
        $date = new \DateTimeImmutable;
        $contact = new Contact(); // Crée une nouvelle instance de l'entité Contact
        $notification = null;
        $form= $this->createForm(ContactType::class, $contact); // Passe l'instance de Contact au formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() ) {
            
            $formInfos = $form->getData();

            $email = $formInfos->getEmail();
            $nom = $formInfos->getNom();
            $prenom = $formInfos->getPrenom();
            $objet = $formInfos->getObjet();
            $message = $formInfos->getMessage();

            $contact = new Contact();
            $contact->setDate($date);
            $contact->setEmail($email);
            $contact->setNom($nom);
            $contact->setPrenom($prenom);
            $contact->setObjet($objet);
            $contact->setMessage($message);

            


            $this->entityManager->persist($contact); // Enregistre l'entité Contact
            $this->entityManager->flush();

            $notification = 'Votre message a bien été pris en compte, nous reviendrons vers vous dès que possible !';
            
            //Envoi un mail aux admins avec le texte du contact
            $mail = new Mail();
            $content = "Bonjour <br>vous avez recu un nouveau message de la part de ".$nom." ".$prenom." sur Les Brunchs de Bob et Tintin <br>
            A propos de : ". $objet."<hr>
            Voici le message : <br><br>".$message."<br> <hr> <br>Répondez a cette adresse : ".$email;
            $mail->send("lesbrunchsdebt@gmail.com", "Les Brunchs de Bob et Tintin ","lesbrunchsdebt@gmail.com", "Contact B&T", 'Nouveau message du formulaire de contact', $content);
        }

        return $this->render('contact/index.html.twig',[
            'form'=> $form->createView(),
            'notification' => $notification,
        ]);
    }
}