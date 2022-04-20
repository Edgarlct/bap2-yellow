<?php

namespace App\Controller\Admin;

use App\Entity\BlogContent;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class BlogContentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogContent::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab("test2"),
            IdField::new('id')->setDisabled()->setColumns(3),
            TextField::new('name')->setColumns(3),
            AssociationField::new("category"),

            FormField::addTab("test"),

            TextEditorField::new('content')->setFormType(CKEditorType::class),

            FormField::addPanel('Paramètres')->setIcon('fa fa-cogs'),

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

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action
                    ->linkToRoute('app_blog_content')
                    ->setIcon('fa fa-file-alt')
                    ->setLabel('Écrire un article');
            })
            ;

    }

}
