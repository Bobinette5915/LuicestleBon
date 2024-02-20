<?php

namespace App\Controller\Admin;

use App\Entity\Boxs;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BoxsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Boxs::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('soustitre'),
            SlugField::new('slug')->setTargetFieldName('nom'),
            ImageField::new("illustration")
                ->setBasePath('assets/images/')
                ->setUploadDir('public/assets/images')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextareaField::new('description'),
            MoneyField::new("prix")->setCurrency("EUR"), 
            AssociationField::new("Categorie"),
            AssociationField::new("Ingredients"),


                ];
    }
}
