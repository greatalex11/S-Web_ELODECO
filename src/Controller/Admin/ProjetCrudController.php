<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Entity\Documents;
use App\Entity\Projet;
use App\Entity\Tache;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
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

            yield CollectionField::new('client')->useEntryCrudForm(ClientCrudController::class)
                ->setEntryIsComplex(true)
                ->setFormTypeOptions([
                    'by_reference' => false,
                ])
                ->setLabel("nom du client"),
//            yield AssociationField::new('client')
//                ->setChoiceLabel('nom')
//                ->autocomplete()
//                ->setChoiceLabel(),


            yield TextEditorField::new('description')->hideOnIndex(),
            yield TextField::new('prestation'),

            yield FormField::addTab("Gestion"),
            yield DateField::new("date_debut"),
            yield NumberField::new('duree'),
            yield TextField::new('budget'),
            yield DateField::new("date_facture")->hideOnIndex(),
            yield NumberField::new('montant_facture')->hideOnIndex(),
            yield DateField::new("date_accompte")->hideOnIndex(),
            yield NumberField::new('montant_accompte')->hideOnIndex(),

            yield FormField::addTab("Artisan"),




            yield FormField::addTab("Liste des taches"),
            yield AssociationField::new('taches')
                ->autocomplete()->setLabel('liste des taches')->hideOnIndex(),

            yield FormField::addTab("Document"),
            yield AssociationField::new('documents')
//                                ->setFormTypeOption('choice_label', 'titre')
                ->setLabel('liste des documents')->hideOnIndex(),


//            yield CollectionField::new('Document')
//                ->useEntryCrudForm(DocumentsCrudController::class)
//                ->setEntryIsComplex(true)
//                ->setFormTypeOptions([
//                    'by_reference' => false,
//                ])
//                ->setLabel("Document"),



        ];
    }

}
