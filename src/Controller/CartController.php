<?php

namespace App\Controller;

use App\Classe\Cart;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{


    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/mon-panier', name: 'app_cart')]
    public function index(Cart $cart): Response
    {
        if ($cart->get()) {
            $cartComplete = $cart->getFull();
    
            return $this->render('cart/index.html.twig', [
                'cart' => $cart->getFull()
            ]);
        }
    
        // Si le panier est vide, vous pouvez rediriger vers une autre page, par exemple
        return $this->redirectToRoute('app_accueil');
    }



    #[Route('/cart/add/{id}', name: 'app_add_to_cart')]
    public function add(Cart $cart ,$id): Response
    {

        $cart->add($id);
            
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/remove', name: 'app_remove_cart')]
    public function remove(Cart $cart): Response
    {

        $cart->remove();
            
        return $this->redirectToRoute('app_accueil');
    }

    #[Route('/cart/delete/{id}', name: 'delete_to_cart')]
    public function deleteFromCart(Cart $cart, $id): Response
    {
        $updatedCart = $cart->delete($id);

        return $this->redirectToRoute('app_cart');
    }
    #[Route('/cart/decrease/{id}', name: 'decrease')]
    public function decreaseFromCart(Cart $cart, $id): Response
{
    $updatedCart = $cart->decrease($id);

    return $this->redirectToRoute('app_cart');
}
}
