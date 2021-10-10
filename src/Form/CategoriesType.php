<?php

namespace App\Form;

use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriesType extends AbstractType
{
    private $_categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->_categoriesRepository = $categoriesRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id_parent', ChoiceType::class, [
                'choices' =>[
                    "Brak" => 0
                ] + $this->_categoriesRepository->getCategories(),
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
            ])
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categories::class,
        ]);
    }
}
