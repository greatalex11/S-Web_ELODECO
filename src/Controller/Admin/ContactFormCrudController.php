<?php

namespace App\Controller\Admin;

use App\Entity\ContactForm;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContactFormCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ContactForm::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            yield IdField::new('id'),
            yield TextField::new('nom'),
            yield TextField::new('prenom'),
            yield DateField::new('date_creation'),
            yield TextField::new('sujet'),

            yield FormField::addTab("Message"),
            yield TextEditorField::new('message'),

            yield FormField::addTab("Coordonnées"),
            yield TextField::new('telephone')
                ->hideOnIndex(),
            yield TextField::new('email')
                ->hideOnIndex(),

        ];
    }
}
