<?php

namespace App\Controller\Admin;

use App\Entity\RequestContact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RequestContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RequestContact::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new("firstName")->setColumns(4)->setDisabled(),
            TextField::new("lastName")->setColumns(4)->setDisabled(),
            EmailField::new("email")->setColumns(4)->setDisabled(),
            AssociationField::new('subject')->setColumns(12)->setDisabled(),
            TextEditorField::new("content")->setColumns(12)->setDisabled(),
            DateTimeField::new('created_at')->setDisabled()
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $detailAction = Action::new('Detail', 'Voir')
            ->setIcon('fas fa-eye')
            ->linkToCrudAction('detail');
        return $actions
            ->add(Crud::PAGE_INDEX, $detailAction)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->remove(Crud::PAGE_DETAIL, Action::EDIT)
            ;

    }

}
