<?php

namespace App\Controller\Admin;

use App\Entity\Mission;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MissionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mission::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->remove(Crud::PAGE_NEW, Action::SAVE_AND_RETURN)
            ->add(Crud::PAGE_NEW, Action::SAVE_AND_CONTINUE);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInPlural('Mes pages Mission')
            ->setEntityLabelInSingular('Ma page Mission')
            ->setAutofocusSearch();
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield FormField::addTab("Ma mission"),
            yield IdField::new('id')->setDisabled(),
            yield TextField::new('missiont1')->setLabel('titre 1'),
            yield TextField::new('missiont2')->setLabel('titre 2')->hideOnIndex(),
            yield TextField::new('missionarg1')->setLabel('argument 1')->hideOnIndex(),
            yield TextField::new('missionarg2')->setLabel('argument 2')->hideOnIndex(),
            yield TextEditorField::new('missiontexte1')->setLabel('texte 1')->hideOnIndex(),
            yield TextField::new('missiont3')->setLabel('titre 3'),
            yield TextField::new('missiont4')->setLabel('titre 4'),
            yield TextField::new('missionarg3')->setLabel('argument 3')->hideOnIndex(),
            yield TextField::new('missionarg4')->setLabel('argument 4')->hideOnIndex(),
            yield TextEditorField::new('missiontexte2')->setLabel('texte 2')->hideOnIndex(),
            yield TextEditorField::new('missiontexte3')->setLabel('texte 3')->hideOnIndex(),
            yield TextField::new('missiont5')->setLabel('titre 5'),
            yield TextField::new('missiont6')->setLabel('titre 6'),

            yield FormField::addTab("Mes images"),
            yield CollectionField::new('image')->useEntryCrudForm(ImageCrudController::class)
                ->setLabel('Mon image')
                ->setHelp('titre de \'image important pour le référencement')
                ->setEntryIsComplex(true)
                ->setFormTypeOptions([
                    'by_reference' => false,
                ])
                ->setColumns(10)
                ->setTemplatePath('fields/images.html.twig'),

            yield ArrayField::new('liste')->setLabel(' Liste des arguments de la pub')->hideOnIndex()

        ];

    }



}
