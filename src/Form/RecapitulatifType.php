<?php

namespace App\Form;

use App\Classe\Cart;
use App\Entity\Commande;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecapitulatifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder , array $options): void
    {
    
        $builder
        // ->add('idUtilisateur', HiddenType::class)
        // ->add('commandeDetails', HiddenType::class)
        ->add('prix', HiddenType::class)
        ->add('idCommande', HiddenType::class)
        ->add('save', SubmitType::class, [
            'label' => 'Payer avec Stripe',
            'attr' => ['class' => 'btn btn-primary']
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
