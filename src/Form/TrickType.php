<?php

namespace App\Form;

use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nom de la figure',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un nom.'
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Le nom doit contenir au minimum {{ limit }} caractères.'
                    ])
                ]
            ])
            ->add('content', TextareaType::class, [
                'required' => true,
                'label' => 'Description',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une description.'
                    ])
                ]
            ])
            ->add('class', EnumType::class, [
                'required' => true,
                'label' => 'Groupe',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un groupe pour cette figure.'
                    ])
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Valider'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
