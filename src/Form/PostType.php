<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\City;
use App\Entity\County;
use App\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PostType extends AbstractType
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //$categoryList   = $this->entityManager->getRepository(Category::class)->getCategoryListWithChildren();
        $categoryList   = $this->entityManager->getRepository(Category::class)->findAll();
        $countyList     = $this->entityManager->getRepository(County::class)->findAll();
        //$cityList       = ['-- Conakry --' => $cityCounties];

        $builder
            ->add('category', ChoiceType::class, [
                'required' => true,
                'choices' => $categoryList,
                'placeholder' => 'Select a Category',
                //'choice_value' => 'category_name',
                'choice_label' => function(?Category $category) {
                    return $category ? strtoupper($category->getCategoryName()) : '';
                },
                'choice_attr' => function(?Category $category) {
                    return $category ? ['class' => 'category_'.strtolower($category->getCategoryName())] : [];
                },
                'group_by' => function(?Category $category) {
                    $catParent = $category->getParent();
                    return $category && $catParent === null ? $category->getCategoryName() : $catParent->getCategoryName();
                },
            ])
            ->add('is_individual', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No'  => false,
                ],
                'multiple' => false,
                'expanded' => true,
                'label' => 'You are individual',
                'required' => true,
            ])
            ->add('post_title', TextType::class, ['label' => 'Title of your ad'])
            ->add('post_detail', TextareaType::class, ['label' => 'Description'])
            ->add('is_seller', ChoiceType::class, [
                'choices' => [
                    'I am a seller' => true,
                    'I am a buyer'  => false,
                ],
                'multiple' => false,
                'expanded' => true,
                'label' => 'Seek/Offer',
                'required' => true,
            ])
            ->add('county', ChoiceType::class, [
                'choices' => $countyList,
                'label' => 'Location',
                'placeholder' => 'Select a County',
                'required' => true,
                'choice_label' => function(?County $county) {
                    return $county ? strtoupper($county->getCountyName()) : '';
                },
                'choice_attr' => function(?County $county) {
                    return $county ? ['class' => 'county_'.strtolower($county->getCountyName())] : [];
                },
                'group_by' => function(?County $county) {
                    return $county->getCity()->getCityName();
                    //return $category && $catParent === null ? $category->getCategoryName() : $catParent->getCategoryName();
                },
            ])
            ->add('address', TextType::class, ['label' => 'Other addess (Quartier)'])
            ->add('images', FileType::class, [
                'label' => 'Images',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                                'image/jpeg',
                                'image/jpg',
                                'image/gif',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ],
            ])
            // ->add(
            //     $builder->create(
            //         'photo', 
            //         FormType::class, [
            //             'by_reference' => true, 
            //             'mapped' => false,
            //             'label' => 'Upload photos'
            //             ])
            //         ->add('image_one', FileType::class, [
            //         'label' => 'Add image 1 (jpg, png)',

            //         // unmapped means that this field is not associated to any entity property
            //         'mapped' => false,

            //         // make it optional so you don't have to re-upload the PDF file
            //         // every time you edit the Product details
            //         'required' => false,
            //         'attr' => ['class' => 'btn btn-file'],

            //         // unmapped fields can't define their validation using annotations
            //         // in the associated entity, so you can use the PHP constraint classes
            //         'constraints' => [
            //             new File([
            //                 'maxSize' => '1024k',
            //                 'mimeTypes' => [
            //                     'image/png',
            //                     'image/jpeg',
            //                     'image/jpg',
            //                     'image/gif',
            //                 ],
            //                 'mimeTypesMessage' => 'Please upload a valid image',
            //             ])
            //         ],
            //     ])
            //     ->add('image_two', FileType::class, [
            //         'label' => 'Add image 2 (jpg, png)',

            //         // unmapped means that this field is not associated to any entity property
            //         'mapped' => false,

            //         // make it optional so you don't have to re-upload the PDF file
            //         // every time you edit the Product details
            //         'required' => false,

            //         // unmapped fields can't define their validation using annotations
            //         // in the associated entity, so you can use the PHP constraint classes
            //         'constraints' => [
            //             new File([
            //                 'maxSize' => '1024k',
            //                 'mimeTypes' => [
            //                     'image/png',
            //                     'image/jpeg',
            //                     'image/jpg',
            //                     'image/gif',
            //                 ],
            //                 'mimeTypesMessage' => 'Please upload a valid image two',
            //             ])
            //         ],
            //     ])
            // )
            ->add('save', SubmitType::class, ['label' => 'Publish your ad'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}