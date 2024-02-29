<?php
namespace App\Classe;

use App\Entity\Boxs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;


class Preparation
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
        
        $preparation = $session->get('preparation', []);
        $preparation[] = [
            'preparation' => $id,
        ];
        $session->set('preparation', $preparation);
    }

    public function get()
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();

        return $session->get('preparation', []);
    }

    public function remove()
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();

        $session->remove('preparation');
    } 
}