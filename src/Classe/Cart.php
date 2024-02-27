<?php

namespace App\Classe;

use App\Entity\Boxs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;


class Cart
{

    

    private $requestStack;
    private $entityManager;
    public function __construct( EntityManagerInterface $entityManager, RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
    }

    public function add($id)
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();

        // Récupérer le panier depuis la session
        $cart = $session->get('cart', []);

        // Ajouter un nouvel article au panier avec l'ID passé en argument
        $cart[] = [
            'id' => $id,
            
        ];

        // Enregistrer le panier mis à jour dans la session
        $session->set('cart', $cart);
    }
    

    
    public function get()
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();

        return $session->get('cart', []);
    }

    public function remove()
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();

        $session->remove('cart');
    } 

    public function delete($id, Request $request)
    {
        $cart = $request->getSession()->get('cart', []);

        // Recherche de l'élément à supprimer dans le panier
        foreach ($cart as $index => $item) {
            if ($item['id']['id'] === $id) {
                // Suppression de l'élément du panier
                unset($cart[$index]);
                break; // Arrêter la boucle dès que l'élément est trouvé et supprimé
            }
        }

        // Mise à jour du panier dans la session
        $request->getSession()->set('cart', $cart);
    }

    public function getFull()
    {
        $cartComplete= [] ;
        foreach ($this->get() as $id => $quantity) {
            $product = $this->entityManager->getRepository(Boxs::class)->find($id);
            
            if ($product) {
                $cartComplete[] = [
                    'product' => $product,
                    
                ];
            }
        }

        return $cartComplete;
    }

    public function addWithIngredients($idbox, $ingredients)
    {
        // Logique pour ajouter une boîte avec des ingrédients supplémentaires au panier
    }

    
}
