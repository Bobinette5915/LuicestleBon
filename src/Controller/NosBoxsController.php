<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Boxs;
use App\Entity\Commande;
use App\Entity\CommandeDetails;
use App\Entity\Ingredients;
use App\Form\PersonnalisationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/ma-box/{slug}', name: 'app_ma_box')]
    public function show(Cart $cart, $slug, Request $request): Response
    {
        $box = $this->entityManager->getRepository(Boxs::class)->findOneBy(['Slug' => $slug]);
        $ingredients = $this->entityManager->getRepository(Ingredients::class)->findAll();

        $BoxIngredients = $box->getIngredients();
        $list_ingredient = [];
        $form = $this->createForm(PersonnalisationType::class);
        

        foreach ($BoxIngredients as $ingredient) {
            $list_ingredient[] = $ingredient;
        }
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
        $formData = $form->getData();
        
        // Vous pouvez maintenant accéder à la boîte choisie et aux ingrédients supplémentaires sélectionnés
        $boxChoisie = $box; // Récupérez la boîte choisie à partir des données de la requête ou de la session
        $formuleId = uniqid();
        $formule = [
            'id' => $formuleId,
            'box' => $boxChoisie,
            'formData' => $formData,
        ];        

        $cart->add($formule);

        return $this->redirectToRoute('app_cart');
    } 
    
    


        if (!$box) {
            return $this->redirectToRoute('app_nos_boxs');
        }

        return $this->render('nos_boxs/afficher.html.twig', [
            'Box' => $box,
            'ingredients' => $list_ingredient,         
            'form' => $form,
            // 'cart'=>$cart
        ]);
        
    }


    #[Route('/panier/{id}', name: 'app_panier_again')]
    public function encore($id, EntityManagerInterface $entityManager, Cart $cart): Response
    {
        
        $repository = $entityManager->getRepository(CommandeDetails::class);
        $commande = $repository->findBy(['Commande' => $id]);
        
        
        foreach ($commande as $ligne) {
            // dd($ligne);
            $nom = $ligne->getNomFormule();
            
            $box = $this->entityManager->getRepository(Boxs::class)->findOneBy(['Nom' => $nom]);
            // dd($ligne);
            $formData = [
                'ingredient1' =>$ligne->getIngredientSupp1(),
                'ingredient2' =>$ligne->getIngredientSupp2(),
                'ingredient3' =>$ligne->getIngredientSupp3(),
                'ingredient4' =>$ligne->getIngredientSupp4(),
            ];
            
            $formuleId = uniqid();
            $formule = [
                'id' => $formuleId,
                'box' => $box,
                'formData' => $formData,
            ];  
                    $cart->add($formule);

        }
        return $this->redirectToRoute('app_cart');
    }
}