<?php

namespace App\Form;

use App\DTO\Cart\SetCartItemRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SetCartItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'bikeId',
                IntegerType::class,
                [
                    'constraints' => [
                        new NotBlank()
                    ]
                ]
            )
            ->add(
                'quantity',
                IntegerType::class,
                [
                    'constraints' => [
                        new NotBlank()
                    ]
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SetCartItemRequest::class,
            'csrf_protection' => false,
        ]);
    }
}
