<?php

namespace App\Controller\Admin;

use App\Entity\Equipe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EquipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Equipe::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setDisabled(),
            ImageField::new('picture')
                ->setColumns(4)
                ->setUploadDir('public/uploads/team')
                ->setBasePath('uploads/team')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setFormTypeOptions([
                    'attr' => [
                        'accept' => 'image/jpeg , image/png'
                    ]
                ])
                ->hideWhenCreating()
                ->setFormTypeOption('required' ,false),
            ImageField::new('picture')
                ->setColumns(4)
                ->setUploadDir('public/uploads/team')
                ->setBasePath('uploads/team')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setFormTypeOptions([
                    'attr' => [
                        'accept' => 'image/jpeg , image/png'
                    ]
                ])
                ->hideWhenUpdating()
                ->hideOnIndex()
                ->setFormTypeOption('required' ,true),
            TextField::new('fisrtName')->setColumns(4),
            TextField::new('lastName')->setColumns(4),
            TextEditorField::new('description')->setColumns(12),
        ];
    }

}
