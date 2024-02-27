<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\VillesLivrables;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
            ->add('Ville', EntityType::class, [ // Utilisation de EntityType
                'class' => VillesLivrables::class, // Entité à utiliser
                'label' => 'Ville :', // Label du champ
            ])
            ->add('Pays', CountryType::class,[
                'label' => "Pays :",
                'preferred_choices' => ['FR'], 
            ])
            ->add('Tel', NumberType::class,[
                'label' => "N° de téléphone :",
                'attr' => [
                    'pattern' => '[0-9]*', // Accepte uniquement les chiffres
                    'title' => "Veuillez saisir uniquement des chiffres" // Message affiché en cas d'erreur
                ]
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