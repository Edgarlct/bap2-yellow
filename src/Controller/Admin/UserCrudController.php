<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ArrayFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use Symfony\Component\Form\ChoiceList\Factory\Cache\ChoiceFilter;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->remove(Crud::PAGE_INDEX, Action::NEW);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            EmailField::new("email")->setDisabled(),
            TextField::new("first_name")->setDisabled(),
            TextField::new("last_name")->setDisabled(),
            NumberField::new("age")->setDisabled(),
            ImageField::new('picture')
                ->setColumns(4)
                ->setUploadDir('public/uploads/user')
                ->setBasePath('uploads/user')
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
                ->setUploadDir('public/uploads/user')
                ->setBasePath('uploads/user')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setFormTypeOptions([
                    'attr' => [
                        'accept' => 'image/jpeg , image/png'
                    ]
                ])
                ->hideWhenUpdating()
                ->hideOnIndex()
                ->setFormTypeOption('required' ,true),
            BooleanField::new("is_sub")->setDisabled(),
            ChoiceField::new('roles')
                ->allowMultipleChoices()->setChoices([
                    'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN'
                ])->renderExpanded(),
            DateTimeField::new("created_at")
                ->setTimezone('Europe/Paris')
                ->setFormat("dd/MM/Y HH:mm:ss")
                ->hideOnForm()
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(ArrayFilter::new("roles")->setChoices([
                'User' => 'ROLE_USER',
                'Admin' => 'ROLE_ADMIN'
            ]))
            ->add("isSub");
    }

}
