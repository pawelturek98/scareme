<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\PageSettings;
use App\Repository\CategoriesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PageSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('page_name', TextType::class, [
                'required' => true,
                'attr' => ['class' => 'form-control']
            ])
            ->add('page_description', TextareaType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('social_facebook', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('social_instagram', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('social_youtube', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('social_discord', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('social_twitter', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('newsletter_enabled', CheckboxType::class, [
                'required' => false,
            ])
            ->add('show_most_popular_post', CheckboxType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PageSettings::class,
        ]);
    }
}
