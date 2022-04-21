<?php

namespace App\Controller\Admin;

use App\Entity\Legal;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class LegalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Legal::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setDisabled(),
            TextEditorField::new('content'),
        ];
    }

}
