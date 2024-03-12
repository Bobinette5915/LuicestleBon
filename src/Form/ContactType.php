<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $date = new \DateTime();

        $builder
        
            ->add('nom', TextType::class, [
                'label'=>'Votre Nom',
                'attr' => [
                    'placeholder'=> 'merci de renseigner votre Nom'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label'=>'Votre Prenom',
                'attr' => [
                    'placeholder'=> 'merci de renseigner votre Prenom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label'=>'Votre Adresse Email',
                'attr' => [
                    'placeholder'=> 'merci de renseigner votre adresse email pour vous repondre'
                ]
            ])
            ->add('objet', TextType::class, [
                'label'=>'Objet',
                'attr' => [
                    'placeholder'=> 'Quel est le sujet de votre message'
                ]
            ])
            ->add('message', TextareaType::class, [
                'label'=>'Votre Message',
                'attr' => [
                    'placeholder'=> 'Dites nous comment nous pouvons vous aider'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label'=>'Envoyer',
                'attr' => [
                    'class'=> 'btn btn-block btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}