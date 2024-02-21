<?php

namespace App\Classe;

use App\Entity\Boxs;
use Doctrine\ORM\EntityManagerInterface;
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

        $cart = $session->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $session->set('cart', $cart);
    }

    public function decrease($id)
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();

        $cart = $session->get('cart', []);


        if ($cart[$id]>1) {
            $cart[$id]--;
        }
        else{
            unset($cart[$id]);
        }
        $session->set('cart', $cart);
        return $cart;
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

    public function delete($id)
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();

        $cart = $session->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        $session->set('cart', $cart);

        return $cart;
    }

    public function getFull()
    {
        $cartComplete= [] ;
        foreach ($this->get() as $id => $quantity) {
            $product = $this->entityManager->getRepository(Boxs::class)->find($id);
            
            if ($product) {
                $cartComplete[] = [
                    'product' => $product,
                    'quantity' => $quantity
                ];
            }
        }

        return $cartComplete;
    }

    
}
