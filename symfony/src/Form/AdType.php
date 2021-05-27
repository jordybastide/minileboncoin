<?php

namespace App\Form;

use App\Entity\Ad;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('shortDescription')
            ->add('price')
            ->add('city')
            ->add('phone')
            ->add('thumbnail', FileType::class, [
                'label' => 'Choisissez une image (Taille maximale 2Mo) : ',
                'required' => false,
                'data_class' => null,
                'empty_data' => '',
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'by_reference' => false,
                'choice_label' => 'name',
                'multiple' => true,
                'required' => true,
                'label' => 'Choisissez une catégorie : ',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
