<?php

namespace App\Form;

use App\Entity\BlogContent;
use App\Entity\Category;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => "formInput"
                ]
            ])
            ->add('openComment')
            ->add('isVisible')
            ->add('category', EntityType::class, [
                // looks for choices from this entity
                'class' => Category::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
            ])
            ->add('content', CKEditorType::class, [
                'label' => false
            ])
            ->add("send", SubmitType::class, [
                'attr' => [
                    'class' => "btn btn-primary"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BlogContent::class,
        ]);
    }
}
