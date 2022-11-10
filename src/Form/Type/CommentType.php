<?php

namespace App\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
       $builder
            ->add('content', TextareaType::class, [
                'label' => 'Votre message'
            ])

            ->add('article', HiddenType::class)
            ->add('send',SubmitType::class, [
                'label' => 'Envoyer'
            ]
            );
    }

}