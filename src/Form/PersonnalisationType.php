<?php

namespace App\Form;

use App\Entity\Ingredients;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnalisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $ingredientsupp = ['ingredient1','ingredient2','ingredient3','ingredient4'];
        $builder
        ->add('idbox', HiddenType::class, [
            'mapped' => false, // Pour ne pas mapper ce champ à une propriété de l'entité

            ]);
    
    
        foreach ($ingredientsupp as $ingredientsupps) {
            $builder->add($ingredientsupps, EntityType::class, [
                "class" => Ingredients::class,
                'required' => false,

            ]);
        }
        $builder
        ->add('submit', SubmitType::class,[
            'label'=> 'Ajouter cette Box au Panier']);
        }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
