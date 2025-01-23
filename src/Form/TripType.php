<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Gallery;
use App\Entity\Localisation;
use App\Entity\Trip;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TripType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ref')
            ->add('title')
            ->add('description')
            ->add('cover')
            ->add('email')
            ->add('status')
            ->add('gallery', EntityType::class, [
                'class' => Gallery::class,
'choice_label' => 'id',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
'choice_label' => 'id',
            ])
            ->add('localisation', EntityType::class, [
                'class' => Localisation::class,
'choice_label' => 'id',
            ])
            ->add('author', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trip::class,
        ]);
    }
}
