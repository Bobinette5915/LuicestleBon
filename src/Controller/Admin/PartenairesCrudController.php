<?php

namespace App\Controller\Admin;

use App\Entity\Partenaires;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PartenairesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Partenaires::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('entreprise'),
            TextField::new('adresse'),
            TextField::new('email'),
            TextField::new('telephone'),
            TextField::new('site_web'),
            ImageField::new("illustration")
                ->setBasePath('assets/images/')
                ->setUploadDir('public/assets/images')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextareaField::new('description'),
            
        ];
    }

}
