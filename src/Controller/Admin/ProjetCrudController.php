<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Entity\Documents;
use App\Entity\Projet;
use App\Entity\Tache;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\TextAlign;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use PhpParser\Node\Expr\Yield_;

class ProjetCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Projet::class;
    }


    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('localite');
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
            ->setEntityLabelInPlural('Projets')
            ->setEntityLabelInSingular('Projet')
            ->setAutofocusSearch()
           ->setDefaultSort(['localite' => 'DESC']);
    }


    public function configureFields(string $pageName): iterable
    {

        return [
            yield FormField::addTab("Identite projet"),

            yield IdField::new('id')->setDisabled(),

             yield SlugField::new('slug')
                 ->setTargetFieldName('titre')
//                 ->setDisabled()
                   ->hideOnIndex(),
            yield TextField::new('titre'),
            //titre2 est repris comme phrase d'intro avant href : projet detail
            yield TextField::new('localite'),
            yield AssociationField::new('client')->autocomplete()
//                ->setTemplatePath('fields/tags.html.twig')
                ->setTextAlign(TextAlign::LEFT),

            yield TextEditorField::new('description')->hideOnIndex(),
            yield ChoiceField::new('prestation')->setChoices(Projet::prestation)->hideOnIndex(),

            yield FormField::addTab("Gestion"),
            yield DateField::new("date_debut"),
            yield NumberField::new('duree')->setHelp('Durée en mois par défaut'),
            yield TextField::new('uniteDuree'),
            yield MoneyField::new('budget')
                ->setCurrency('EUR')
                ->setTextAlign(TextAlign::LEFT),
            yield DateField::new("date_facture")->hideOnIndex(),
            yield MoneyField::new('montant_facture')
                ->setCurrency('EUR')->hideOnIndex()
                ->setTextAlign(TextAlign::CENTER)
                ->setColumns(6),

            yield DateField::new("date_accompte")->hideOnIndex(),
            yield MoneyField::new('montant_accompte')
                ->setCurrency('EUR')->hideOnIndex()
                ->setTextAlign(TextAlign::CENTER)
                ->setColumns(6),
            yield FormField::addTab("Commerciale"),
            yield TextField::new('titre2')
                ->setLabel('Accroche courte sur photo'),

            yield CollectionField::new('list')->hideOnIndex()
                ->setLabel('Arguments vendeurs du projet'),

            yield CollectionField::new('image')->useEntryCrudForm(ImageCrudController::class)
                ->setLabel('titre de l\'image - important pour le référencement')
                ->setEntryIsComplex(true)
                ->setFormTypeOptions([
                    'by_reference' => false,
                ])
                ->setColumns(10)
                ->setTemplatePath('fields/images.html.twig'),

            yield TextEditorField::new('texte2')->hideOnIndex()
            ->setLabel('Mot pour accroche finale'),

            yield FormField::addTab("Liste des taches"),
            yield AssociationField::new('taches')
                ->autocomplete()->setLabel('liste des taches'),

            yield FormField::addTab("Document"),
            yield CollectionField::new('documents')
                ->useEntryCrudForm(DocumentsCrudController::class)
                ->setEntryIsComplex(true)
                ->setFormTypeOptions([
                    'by_reference' => false,
                    'document.tire'=>$this->getContext()->getEntity()->getFields()->getTitre()
                ])
                ->setLabel("Document")
                ->hideOnIndex()
        ];
    }

}
