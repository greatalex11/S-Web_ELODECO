<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Entity\Documents;
use App\Entity\Projet;
use App\Entity\Tache;
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
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use PhpParser\Node\Expr\Yield_;

class ProjetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Projet::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield FormField::addTab("Identite projet"),
            yield IdField::new('id')->setDisabled(),
            yield TextField::new('titre'),
            yield TextField::new('localite'),


//
//            yield CollectionField::new('client')
//                ->setEntryIsComplex(true)
//               ->setFormTypeOptions([
//                    'by_reference' => false,
//                ]),

            yield AssociationField::new('client')->autocomplete()
                ->setTemplatePath('fields/tags.html.twig')
                ->setTextAlign(TextAlign::LEFT),

            yield TextEditorField::new('description')->hideOnIndex(),
            yield ChoiceField::new('prestation')->setChoices(Projet::prestation),

            yield FormField::addTab("Gestion"),
            yield DateField::new("date_debut"),
            yield NumberField::new('duree'),
            yield MoneyField::new('budget')->setCurrency('EUR'),
            yield DateField::new("date_facture")->hideOnIndex(),
            yield MoneyField::new('montant_facture')->setCurrency('EUR')->hideOnIndex(),
            yield DateField::new("date_accompte")->hideOnIndex(),
            yield MoneyField::new('montant_accompte')->setCurrency('EUR')->hideOnIndex(),


            yield FormField::addTab("Artisan"),


            yield FormField::addTab("Liste des taches"),
            yield AssociationField::new('taches')
                ->autocomplete()->setLabel('liste des taches')->hideOnIndex(),

            yield FormField::addTab("Document"),
            yield CollectionField::new('documents')
               ->useEntryCrudForm(DocumentsCrudController::class)
                ->setEntryIsComplex(true)
                ->setFormTypeOptions([
                    'by_reference' => false,
                ])
                ->setLabel("Document"),



        ];
    }

}
