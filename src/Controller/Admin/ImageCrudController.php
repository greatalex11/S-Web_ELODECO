<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ImageCrudController extends AbstractCrudController
{
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('contenus');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInPlural('Images')
            ->setEntityLabelInSingular('Image')
            ->setAutofocusSearch()
            ->setDefaultSort(['updatedAt' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        //FORM
        $isPeripherique = $this->getContext()?->getCrud()?->getEntityFqcn() === PeripheriquesCrudController::getEntityFqcn();
        if (!$isPeripherique) {
            yield TextField::new('titre')->setFormTypeOptions(
                [
                    'attr' => [
                        'required' => true,
                    ],
                    'label_attr' => ['class' => 'required label-required']
                ]
            )->setColumns(12);
        } else {
            yield HiddenField::new('isPeripherique')->setEmptyData(true);
        }
        yield TextField::new('onPage')->setLabel('Pages')->onlyOnIndex();
        yield TextField::new('usedBy')->setLabel('Utilisé par')->onlyOnIndex();
        yield TextField::new('type')->onlyWhenUpdating()->setDisabled()->setColumns(12);
        yield IntegerField::new('size')->onlyWhenUpdating()->setDisabled()->setLabel("Taille")->setColumns(12);
        yield TextField::new('dimensions')->onlyWhenUpdating()->setDisabled()->setColumns(12);
        yield TextField::new('imageFile')
            ->setLabel(false)
            ->setFormType(VichImageType::class)
            ->setFormTypeOptions([
                'allow_delete' => false,
            ])
            ->setColumns(12)
            ->onlyOnForms();

        // Not in FORM
        yield TextField::new('type')->hideOnForm();
        yield IntegerField::new('sizeKo')->hideOnForm()->setLabel("Taille");
        yield IntegerField::new('dimensions')->hideOnForm();
        yield ImageField::new('image')
            ->setBasePath('assets/images/uploads')
            ->hideOnForm();
        yield DateTimeField::new('createdAt')->hideOnForm()->onlyOnDetail();
        yield DateTimeField::new('updatedAt')->hideOnForm()->setLabel('Dernière modification');
    }

    public static function getEntityFqcn(): string
    {
        return Image::class;
    }

}
