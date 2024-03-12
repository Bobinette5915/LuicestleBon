<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FloatField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }

    

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            DateField::new('dateCommande','Commandée le'),
            DateField::new('dateLivraison', 'A Livrer le'),
            TimeField::new('heureLivraison', 'Heure de livraison'),
            BooleanField::new('isPaid', 'Payée ou non'),
            MoneyField::new('prix')->setCurrency('EUR'),
            ChoiceField::new('Statue', 'Etat de la commande')
            ->setChoices([
                'Payée' => 'Payée',
                'En cours de Préparation' => 'En Cours de Preparation',
                'A livrer' => 'A livrer',
                'Livrée' => 'Livrée',
            ]),
        ];
    }
    
}
