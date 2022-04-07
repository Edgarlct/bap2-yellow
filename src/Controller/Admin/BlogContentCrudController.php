<?php

namespace App\Controller\Admin;

use App\Entity\BlogContent;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BlogContentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogContent::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
