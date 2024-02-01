<?php

namespace App\Controller\Admin;

use App\Entity\ContactForm;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use phpDocumentor\Reflection\Types\Boolean;

class ContactFormCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ContactForm::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield FormField::addTab("listing"),
//            yield IdField::new('id'),
            yield TextField::new('nom'),
            yield TextField::new('sujet'),
            yield DateField::new('date_creation'),
            yield ChoiceField::new('status')
            ->setChoices(ContactForm::statusMsg)
                ->setEmptyData('A traiter')
            ->setLabel('statut'),

            yield BooleanField::new('msgLu')->renderAsSwitch()
                ->setLabel('Pas encore lu')
                ->setTemplatePath('fields/bouton.html.twig'),

            yield FormField::addTab("Message")->hideOnIndex(),
            yield TextEditorField::new('message')->hideOnIndex(),

            yield FormField::addTab("Coordonnées")->hideOnIndex(),
            yield TextField::new('prenom')->hideOnIndex(),
            yield TextField::new('nom')->hideOnIndex(),
            yield TextField::new('telephone')
                ->hideOnIndex(),
            yield TextField::new('email')
                ->hideOnIndex(),

        ];
    }
}
