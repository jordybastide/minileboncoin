<?php

namespace App\Form;

use App\Entity\Ad;
use App\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre :'
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Descriptif :'
            ])
            ->add('shortDescription', TextType::class, [
                'label' => 'Descritpion courte (optionnel) :'
            ])
            ->add('price', IntegerType::class, [
                'label' => 'Prix :'
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville :'
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone :'
            ])
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
