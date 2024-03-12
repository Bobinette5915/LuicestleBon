<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Classe\Preparation;
use App\Entity\User;
use App\Entity\Adresse;
use App\Entity\Commande;
use App\Entity\CommandeDetails;
use App\Entity\Jours;
use App\Entity\Heures;
use App\Form\CreneauxType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreneauxController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/compte/creneaux', name: 'app_creneaux')]
    public function index(Cart $cart, Request $request, Preparation $preparation, EntityManagerInterface $entityManager): Response
    {
        $notification = null;
        if ($cart->get()) {

            $user = $this->getUser();

            $form = $this->createForm(CreneauxType::class, null, [
                'user' => $this->getUser(),
            ]);

            $form->handleRequest($request);

            $prixTotal = null;
            // dd($cart->get());
            foreach ($cart->get() as $key => $value) {
                // Vérifiez si la propriété 'id' existe et si elle est un tableau associatif
                if (isset($value['id']) && is_array($value['id'])) {
                    // Accédez à la propriété 'box' dans 'id'
                    $box = $value['id']['box'];
                    // Accédez à la propriété 'Prix' de l'objet Boxs
                    $prix = $box->getPrix();
                    // on ajoute le prix de la box a la variable prixTotal
                    $prixTotal = $prixTotal + $prix;
                }
            }
            // dd($prixTotal);
            if ($form->isSubmitted() && $form->isValid()) {



                $formInfos = $form->getData();
                //dd($formInfos);
                $joursObjet = $formInfos['Jours'];
                $JoursSelect = $joursObjet->getJours();
                $HeureObjet = $formInfos['Heures'];
                $heureSelect = $HeureObjet->getHeuresLivrables();

                // Récupérer le repository de l'entité Commande
                $repository = $this->entityManager->getRepository(Commande::class);

                // Construire la requête
                $queryBuilder = $repository->createQueryBuilder('c');
                $queryBuilder->where('c.dateLivraison = :date_livraison');
                $queryBuilder->andWhere('c.heureLivraison = :heure_livraison');
                $queryBuilder->setParameter('date_livraison', $JoursSelect);
                $queryBuilder->setParameter('heure_livraison', $heureSelect);

                // Exécuter la requête
                $commandes = $queryBuilder->getQuery()->getResult();
                
                if (empty($commandes)) {
                    
                    $idCommande = uniqid();
                    $commande = [
                        'idCommande' => $idCommande,
                        'idUtilisateur' => $user->getId(),
                        'cart' => $cart->get(),
                        'infosLivraison' => $formInfos,
                        'prix' => $prixTotal,

                    ];
                    $preparation->add($commande);




                    $dateFormatted = $formInfos['Jours']->getJours();
                    $heureFormatted = $formInfos['Heures']->getHeuresLivrables();
                    $adresseLivraison = $formInfos['Adresse'];


                    $date = new \DateTime();
                    $date->setTime(0, 0, 0);
                    //enregistrer la commande dans Commande
                    $commande = new Commande();
                    $commande->setIdUtilisateur($user->getId());
                    $commande->setNomUtilisateur($user->getNom());
                    $commande->setPrenomUtilisateur($user->getPrenom());
                    $commande->setTelephone($user->getTel());
                    $commande->setDateCommande($date);
                    $commande->setDateLivraison($dateFormatted);
                    $commande->setHeureLivraison($heureFormatted);
                    $commande->setPrix($prixTotal);
                    $commande->setAdresseLivraison($adresseLivraison);
                    $commande->setIdCommande($idCommande);
                    $commande->setIsPaid(0);
                    $commande->setStatue('A Payer');


                    $this->entityManager->persist($commande);


                    //Enregistrer le pannier dans CommandeDetail

                    foreach ($cart->get() as $box) {

                        $commandeDetail = new CommandeDetails();

                        $ingredient = $box['id']['formData'];

                        $commandeDetail->setCommande($commande);
                        $commandeDetail->setIdFormuleUnique($box['id']['id']);
                        $commandeDetail->setIdFormule($box['id']['box']->getId());
                        $commandeDetail->setNomFormule($box['id']['box']->getNom());

                        if ($ingredient['ingredient1']) {
                            $commandeDetail->setIngredientSupp1($ingredient['ingredient1']->getIngredient());
                        }
                        if ($ingredient['ingredient2']) {
                            $commandeDetail->setIngredientSupp2($ingredient['ingredient2']->getIngredient());
                        }
                        if ($ingredient['ingredient3']) {
                            $commandeDetail->setIngredientSupp3($ingredient['ingredient3']->getIngredient());
                        }
                        if ($ingredient['ingredient4']) {
                            $commandeDetail->setIngredientSupp4($ingredient['ingredient4']->getIngredient());
                        }


                        $this->entityManager->persist($commandeDetail);
                    }

                    //attention a decommenter lors du deploiment 
                    $this->entityManager->flush();

                    return $this->redirectToRoute('app_recapitulatif');
                }
                else {
                    $notification = "Cet horraire est malheureusement deja prix , essayez en un autre";
                }
                
            }


            return $this->render('creneaux/index.html.twig', [
                'cart' => $cart->get(),
                'form' => $form->createView(),
                'notification' => $notification,

            ]);
        } else {
            // Si le panier est vide, vous pouvez rediriger vers une autre page, par exemple
            return $this->redirectToRoute('app_accueil');
        }
    }
}
