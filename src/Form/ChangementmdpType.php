<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangementmdpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class, [
                'disabled'=>true,
                'label'=> 'Mon adresse mail',
            ])
            ->add('nom', TextType::class, [
                'disabled'=>true,
                'label'=> 'Mon nom',
            ])
            ->add('prenom', TextType::class, [
                'disabled'=>true,
                'label'=> 'Mon prénom',
            ])
            ->add('old_password', PasswordType::class, [
                'mapped' => false,
                'label' => 'Mot de passe actuel',
                ])
            
            ->add('new_password',RepeatedType::class, [
                    'type'=> PasswordType::class,
                    'mapped' => false,
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
            'data_class' => User::class,
        ]);
    }
}
