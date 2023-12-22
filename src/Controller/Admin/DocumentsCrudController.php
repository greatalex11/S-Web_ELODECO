<?php

namespace App\Controller\Admin;

use App\Entity\Documents;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DocumentsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Documents::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
//            IdField::new('id'),
            ChoiceField::new('type')
                ->setChoices(Documents::TYPEDEDOCUMENT),
            TextField::new('titre'),
            TextEditorField::new('description'),
            ChoiceField::new('mise_en_copie')
                ->allowMultipleChoices()
                ->setChoices(Documents::MISEENCOPIE),
        ];
    }

}
