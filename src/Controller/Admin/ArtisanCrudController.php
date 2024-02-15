<?php

namespace App\Controller\Admin;

use App\Entity\Artisan;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArtisanCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Artisan::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInPlural('Artisans')
            ->setEntityLabelInSingular('Artisan')
            ->setAutofocusSearch();
    }
    
    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield FormField::addTab("User", 'fas fa fa-user');
        yield AssociationField::new("user")->renderAsEmbeddedForm()->setLabel(false);

        yield FormField::addTab("Informations", 'fas fa fa-info');
        yield TextField::new("raison_sociale")->setLabel('raison sociale');
        yield TextField::new("nom_etablissement")->setLabel('nom entreprise');

    }
}
