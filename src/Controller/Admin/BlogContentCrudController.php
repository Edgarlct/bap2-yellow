<?php

namespace App\Controller\Admin;

use App\Entity\BlogContent;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BlogContentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogContent::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setDisabled()->setColumns(3),
            TextField::new('name')->setColumns(3),
            AssociationField::new("category"),
            TextEditorField::new('content')->setColumns(12),
            BooleanField::new("open_comment")->setColumns(2),
            BooleanField::new("is_visible")->setColumns(2),
            DateTimeField::new("created_at")
                ->setTimezone('Europe/Paris')
                ->setFormat("dd/MM/Y HH:mm:ss")
                ->hideOnForm(),
            DateTimeField::new("updated_at")
                ->setTimezone('Europe/Paris')
                ->setFormat("dd/MM/Y HH:mm:ss")
                ->hideOnForm()
        ];
    }

}
