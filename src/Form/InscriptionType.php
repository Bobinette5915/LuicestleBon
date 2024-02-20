<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'label' => 'Nom',
            'attr' => ['class' => 'form-control']
        ])
        ->add('prenom', TextType::class, [
            'label' => 'Prénom',
            'attr' => ['class' => 'form-control']
        ])
        ->add('email', EmailType::class, [
            'label' => 'Email',
            'attr' => ['class' => 'form-control']
        ])
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques',
            'required' => true,
            'first_options' => [
                'label' => 'Mot de passe',
                'attr' => ['class' => 'form-control'], 
            ],
            'second_options' => [
                'label' => 'Confirmez votre mot de passe',
                'attr' => ['class' => 'form-control'], 
            ],
        ])
        ->add('submit', SubmitType::class,[
            'label'=> "S'inscrire",
            'attr'=> ['class'=> 'btn btn-info w-100 mt-3']
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

