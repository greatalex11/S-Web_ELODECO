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
        yield AssociationField::new('pages')->autocomplete()
            ->setTemplatePath('fields/tags.html.twig')
            ->setTextAlign(TextAlign::LEFT);
        yield ChoiceField::new('type')
            ->setChoices(Contenus::TYPES);
        yield TextField::new('titre1')->hideOnIndex();
        yield TextField::new('titre2')->hideOnIndex();
        yield TextField::new('titre3')->hideOnIndex();
        yield TextField::new('texte1')->hideOnIndex();
        yield TextField::new('texte2')->hideOnIndex();
        yield TextField::new('texte3')->hideOnIndex();
        yield BooleanField::new('publier');
        yield CollectionField::new('images')
            ->useEntryCrudForm(ImageCrudController::class)
            ->setEntryIsComplex(true)
            ->setFormTypeOptions([
                'by_reference' => false,
            ])
            ->setTemplatePath('fields/count.html.twig');
        yield DateTimeField::new('updatedAt')->hideOnForm()->setLabel('Dernière modification');
    }

}
