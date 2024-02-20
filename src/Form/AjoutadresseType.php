<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjoutadresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nomadresse', TextType::class,[
                'label' => "Nom de l'adresse :",
                'attr'=>[
                    'placeholder' => "Nommez votre adresse"
                ]
            ])
            ->add('Nom', TextType::class,[
                'label' => "Votre Nom :",
            ])
            ->add('Prenom', TextType::class,[
                'label' => "Votre Prénom :",
            ])
            ->add('Adresse', TextType::class,[
                'label' => "Votre adresse :",
            ])
            ->add('Postal', TextType::class,[
                'label' => "Code postal :",
            ])
            ->add('Ville', TextType::class,[
                'label' => "Ville :",
            ])
            ->add('Pays', CountryType::class,[
                'label' => "Pays :",
                'preferred_choices' => ['FR'], 
            ])
            ->add('Tel', TelType::class,[
                'label' => "N° de téléphone :",
            ])
            ->add('submit', SubmitType::class,[
                'label'=> 'Valider',
                'attr' =>[
                    'class' => 'btn btn-info w-100 mt-4'
                ]
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}