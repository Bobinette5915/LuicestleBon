<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Boxs;
use App\Entity\Ingredients;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RequestStack;


class CartController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/compte/cart/add', name: 'app_add_to_cart')]
    public function add(Cart $cart, $idbox, Request $request): Response
    {

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/compte/mon-panier', name: 'app_cart')]
    public function index(Cart $cart): Response
    {
        if ($cart->get()) {

            return $this->render('cart/index.html.twig', [
                'cart' => $cart->get(),
            ]);
        }
        if ($cart->get()) {

            return $this->redirectToRoute('app_cart');
        }

        else {
            // Si le panier est vide, vous pouvez rediriger vers une autre page, par exemple
        return $this->redirectToRoute('app_accueil');
        }
        
    }


    #[Route('/cart/remove', name: 'app_remove_cart')]
    public function remove(Cart $cart): Response
    {

        $cart->remove();

        return $this->redirectToRoute('app_accueil');
    }



    #[Route('/cart/delete/{id}', name: 'app_delete_to_cart')]
public function deleteFromCart(Cart $cart, $id, RequestStack $requestStack): Response
{
    if (count($cart->get()) > 1){
        $request = $requestStack->getCurrentRequest();
        
    $cart->delete($id, $request);

    return $this->redirectToRoute('app_cart');
    
    }
    else {
        return $this->redirectToRoute('app_remove_cart');
    }
    
}}