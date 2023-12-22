<?php

namespace App\Controller\Admin;

use App\Entity\Documents;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Date;

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

            yield SlugField::new('slug')->setTargetFieldName('titre'),
            yield TextField::new('titre'),

            yield ChoiceField::new('type')
                ->setChoices(Documents::TYPEDEDOCUMENT),

            yield TextEditorField::new('description'),
            yield ChoiceField::new('mise_en_copie')
                ->allowMultipleChoices()
                ->setChoices(Documents::MISEENCOPIE),
            yield DateField::new('date_peremption')
                ->renderAsChoice()
                ->setLabel('date à laquelle le document peut être retiré du site')
        ];
    }

}
