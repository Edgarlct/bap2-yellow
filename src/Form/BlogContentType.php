<?php

namespace App\Form;

use App\Entity\BlogContent;
use App\Entity\Category;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

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
            ->add('picture', FileType::class, [
                'label' => 'Image de couverture',
                'multiple' => false,
                'mapped' => false,
                'required' => false,
                'constraints' => [
                        new File([
                            'maxSize' => '2048k',
                            'mimeTypes' => [
                                'image/jpeg',
                                'image/png'
                            ],
                            "mimeTypesMessage" => "Selection une image valide"
                        ])
                ],
                "attr" => [
                    "class" => "form-control"
                ]
            ])            ->add('content', CKEditorType::class, [
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
