<?php

namespace App\Controller\Admin;

use App\Entity\Jours2;
use App\Repository\Jours2Repository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class Jours2CrudController extends AbstractCrudController
{
    private $jours2Repository;

    public function __construct(Jours2Repository $jours2Repository)
    {
        $this->jours2Repository = $jours2Repository;
    }

    public static function getEntityFqcn(): string
    {
        return Jours2::class;
    }

    public function configureFields(string $pageName): iterable
    {
   
        return [
            DateField::new('Jours')->formatValue(function ($value, $entity) {
                // Convertir la valeur de la date en objet DateTime
                $date = $value instanceof \DateTimeInterface ? $value : new \DateTime($value);
                // Définir les jours de la semaine en français
                $jours = [
                    'Monday' => 'Lundi',
                    'Tuesday' => 'Mardi',
                    'Wednesday' => 'Mercredi',
                    'Thursday' => 'Jeudi',
                    'Friday' => 'Vendredi',
                    'Saturday' => 'Samedi',
                    'Sunday' => 'Dimanche',
                ];
                // Définir les mois en français
                $mois = [
                    'January' => 'Janvier',
                    'February' => 'Février',
                    'March' => 'Mars',
                    'April' => 'Avril',
                    'May' => 'Mai',
                    'June' => 'Juin',
                    'July' => 'Juillet',
                    'August' => 'Août',
                    'September' => 'Septembre',
                    'October' => 'Octobre',
                    'November' => 'Novembre',
                    'December' => 'Décembre',
                ];

                // Récupérer le nom du jour et du mois en français
                $jourEnFrancais = $jours[$date->format('l')];
                $moisEnFrancais = $mois[$date->format('F')];
                
                // Formater la date pour afficher le nom du jour et du mois en français
                return $jourEnFrancais . ' ' . $date->format('d') . ' ' . $moisEnFrancais . ' ' . $date->format('Y');
            })->setLabel('Jours'),

            BooleanField::new('Disponible')->setLabel('Disponible')->renderAsSwitch(),
        ];
    }
}