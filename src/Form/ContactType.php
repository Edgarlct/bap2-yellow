<?php

namespace App\Form;

use App\Entity\RequestContact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content')
            ->add('email')
            ->add('firstName')
            ->add('lastName')
            ->add('subject')
            ->add('send', SubmitType::class, [
                'label' => 'Contacter'
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
