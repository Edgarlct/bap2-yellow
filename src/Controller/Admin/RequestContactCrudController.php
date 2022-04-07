<?php

namespace App\Controller\Admin;

use App\Entity\RequestContact;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RequestContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RequestContact::class;
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
