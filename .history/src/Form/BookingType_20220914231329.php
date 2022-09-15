<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\Massage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'attr' => [
                    'placeholder' => 'Titre'
                ]
            ])
            ->add('debut', DateTimeType::class, [
                'widget' => 'single_text',
                'input' => 'datetime',
                'html5' => false,
                'attr' => [
                    'class' => 'combinedPickerInput',
                    'placeholder' => date('d/m/y H:i'),
                ],
                'format' => 'd/m/Y H:i',
                'date_format' => 'd/m/Y H:i',
                'label' => 'form.specialOffer.startDate',
                'translation_domain' => 'Default',
                'required' => false,
               
            ])
            ->add('fin', DateTimeType::class, [
                'date_widget' => 'single_text',
                'input' => 'datetime'
            ])
            ->add('service', EntityType::class, [
                'class' => Massage::class,
                'choice_label' => 'titre',
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}