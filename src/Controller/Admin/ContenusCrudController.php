<?php

namespace App\Controller\Admin;


use App\Entity\Contenus;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\TextAlign;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContenusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contenus::class;

    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInPlural('Contenus')
            ->setEntityLabelInSingular('Contenu')
            ->setAutofocusSearch()
            ->setDefaultSort(['updatedAt' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {

        yield FormField::addTab("Page");
        yield AssociationField::new('pages')->autocomplete()
            ->setTemplatePath('fields/tags.html.twig')
            ->setTextAlign(TextAlign::LEFT);
        yield ChoiceField::new('type')
            ->setChoices(Contenus::TYPES);
        yield FormField::addTab("Contenu");
        yield FormField::addPanel("Titres")->collapsible()->renderCollapsed();
        yield TextField::new('titre1');
        yield TextField::new('titre2')->hideOnIndex()->setColumns(6);
        yield TextField::new('titre3')->hideOnIndex();
        yield FormField::addPanel("Détails");
        yield TextEditorField::new('texte1')->hideOnIndex()->setTemplatePath('fields/raw.html.twig');
        yield TextareaField::new('texte2')->hideOnIndex();
        yield TextareaField::new('texte3')->hideOnIndex();
        yield BooleanField::new('publier');
        yield CollectionField::new('images')
            ->useEntryCrudForm(ImageCrudController::class)
            ->setEntryIsComplex(true)
            ->setFormTypeOptions([
                'by_reference' => false,
            ])
            ->setColumns(12)
            ->setTemplatePath('fields/images.html.twig');
        yield DateTimeField::new('updatedAt')->hideOnForm()->setLabel('Dernière modification');

    }

}
