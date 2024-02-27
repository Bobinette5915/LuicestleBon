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
        $contact = new Contact(); // Crée une nouvelle instance de l'entité Contact
        $notification = null;
        $form= $this->createForm(ContactType::class, $contact); // Passe l'instance de Contact au formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($contact); // Enregistre l'entité Contact
            $this->entityManager->flush();

            $notification = 'Votre message a bien été pris en compte, nous reviendrons vers vous dès que possible !';
            
            // Envoi un mail aux admins avec le texte du contact
            // $mail = new Mail();
            // $content = "Bonjour <br>vous avez recu un nouveau message de la part de ".$contact->getNom()." ".$contact->getPrenom()." sur Les Brunchs de Bob et Tintin <br>
            // A propos de : ". $contact->getObjet()."<hr>
            // Voici le message : <br><br>".$contact->getMessage()."<br> <hr> <br>Répondez a cette adresse : ".$contact->getEmail();
            // $mail->send("chewie.59@hotmail.fr", "Nom du site ", 'Nouveau message du formulaire de contact', $content);
        }

        return $this->render('contact/index.html.twig',[
            'form'=> $form->createView(),
            'notification' => $notification,
        ]);
    }
}