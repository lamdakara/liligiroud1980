<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname', TextType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'Prénom'
            ]
        ])
        ->add('lastname', TextType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'Nom'
            ]
        ])
        ->add('email', EmailType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'Email'
            ]
        ])
        ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Accepter les conditions du site',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions',
                    ]),
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Mot incorrect',
                'options' => [
                    'attr' => [
                        'class' => 'password-field',
                    ]
                ],
                'required' => true,
                'first_options'  => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Mot de passe',
                        'class' => 'form-control mb-2 mt-2'
                    ]
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Confirmation de mot de passe',
                        'class' => 'form-control'
                    ]
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le mot de passe ne doit pas être vide !',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Minimum 6 caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
