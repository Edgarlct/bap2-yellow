<?php

namespace App\Form;

use App\Entity\RequestContact;
use App\Entity\SubjectContact;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'attr' => [
                    'class' => "form-control",
                    'placeholder' => "Prénom"
                ],
                'label' => false,
            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'class' => "form-control",
                    'placeholder' => "Nom"
                ],
                'label' => false,
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => "form-control",
                    'placeholder' => "E-mail"
                ],
                'label' => false,

            ])
            ->add('subject',EntityType::class, [
                // looks for choices from this entity
                'class' => SubjectContact::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'name',

                'attr' => [
                    'class' => "form-control"
                ],
                'label' => 'Sujet de la demande de contact',
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'class' => "form-control",
                    'placeholder' => "Votre message"
                ],
                'label' => false,
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Contacter',
                'attr' => [
                    'class' => "buttonContact",
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RequestContact::class,
        ]);
    }
}
