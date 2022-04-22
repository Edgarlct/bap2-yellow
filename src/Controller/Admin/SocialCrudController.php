<?php

namespace App\Controller\Admin;

use App\Entity\Social;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SocialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Social::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setDisabled(),
            TextField::new('url'),
            ImageField::new('image')
                ->setUploadDir('public/uploads/icon')
                ->setBasePath('uploads/icon')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setFormTypeOptions([
                    'attr' => [
                        'accept' => 'image/jpeg , image/png'
                    ]
                ]),
            AssociationField::new('type')
        ];
    }

}
