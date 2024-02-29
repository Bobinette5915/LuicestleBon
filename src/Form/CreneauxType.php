<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Heures;
use App\Entity\Jours;
use App\Entity\Jours2;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreneauxType extends AbstractType
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user'];
        

        $builder
            ->add('Adresse', EntityType::class, [ 
                'class' => Adresse::class,
                'label' => 'Adresse :', 
                'choices' => $user->getAdresses(),
                'multiple' => false,
                'expanded' => true,
                'required' =>true,
                'attr' => [
                    'class' => 'form-control',
                ]
        ])

            ->add('Jours',EntityType::class, [ 
                'class' => Jours2::class,
                'label' => 'Jour de Livraison :', 
                'required' => true,
                'multiple' =>false,
                'query_builder' => function ($repository) {
                    return $repository->createQueryBuilder('j')
                        ->where('j.Disponible = :disponible')
                        ->setParameter('disponible', true);
                },   
            ])
        
            ->add('Heures',EntityType::class, [ 
                'class' => Heures::class,
                'label' => 'Creneaux :',
                'required' => true,
                'multiple' =>false,
                
            ])
            ->add('submit', SubmitType::class, [
                'label'=>'Valider et Payer',
                'attr'=> [
                    'class'=>'btn btn-success w-100 mx-auto text-center'
                ]
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'user'=> null,
        ]);
    }
}
