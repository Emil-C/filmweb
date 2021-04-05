<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class LanguageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('language', ChoiceType::class, [
                'choices' => [
                    'English' => 'en',
                    'Polish' => 'pl',
                ]
            ])
        ;
    }
}