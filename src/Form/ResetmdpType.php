<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResetmdpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('new_password',RepeatedType::class, [
            'type'=> PasswordType::class,
            'invalid_message'=>'Le mot de passe et la confirmation doivent être identiques',
            'label' =>'Nouveau mot de passe ',
            'required'=> true,
            'first_options'=>[
                'label'=>'Nouveau Mot de passe',
    ],
            'second_options'=>[
                'label'=>'Confirmez votre nouveau mot de passe',
        ]                    
    ])
    ->add('submit', SubmitType::class,[
        'label'=> "Valider le changement",
        'attr'=> ['class'=> 'btn btn-info w-100 mt-3']
    ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
