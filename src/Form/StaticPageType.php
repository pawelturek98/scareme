<?php

namespace App\Form;

use App\Entity\StaticPage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StaticPageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('robots')
            ->add('seo_title')
            ->add('seo_description')
            ->add('seo_url')
            ->add('layout')
            ->add('published')
            ->add('created_at')
            ->add('published_at')
            ->add('author')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => StaticPage::class,
        ]);
    }
}
