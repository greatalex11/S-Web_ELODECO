<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
//            yield IdField::new('id'),
            yield TextField::new('titre'),
            yield TextField::new('format'),
            yield IntegerField::new('hauteur'),
            yield IntegerField::new('largeur'),
            yield TextField::new('dimensions'),
            yield ImageField::new('image')
                ->setBasePath('assets/images/')
                ->setUploadDir("/public/assets/images/"),
        ];
    }

}
