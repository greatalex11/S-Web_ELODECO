<?php

namespace App\Controller\Admin;



use App\Entity\Contenus;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use phpDocumentor\Reflection\Types\Integer;

class ContenusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contenus::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield AssociationField::new('page')->autocomplete(),
            yield TextField::new('type'),
            yield TextField::new('titre1'),
            yield TextField::new('titre2'),
            yield TextField::new('titre3'),
            yield TextField::new('texte1'),
            yield TextField::new('texte2'),
            yield TextField::new('texte3'),
            yield DateTimeField::new('date_creation'),
            //AssociationField :new('images'),
            //yield TextField::new('page'),
//            yield IntegerField::new('largeur'),
//            yield TextField::new('dimensions'),
            yield CollectionField::new('images') ->useEntryCrudForm(ImageCrudController::class),

        ];
    }

}
