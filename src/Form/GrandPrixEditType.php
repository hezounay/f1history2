<?php

namespace App\Form;

use App\Form\ImageType;
use App\Entity\GrandPrix;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;



class GrandPrixEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder'=>"Nom du Grand-Prix"
                ]
            ])
            ->add('date', TextType::class, [
                'label' => 'Date',
                'attr' => [
                    'placeholder'=>"Année où le Grand-Prix a eu lieu"
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description détaillée',
           
            ])

                ->add('laps', TextType::class, [
                    'label' => 'Tours',
                    'attr' => [
                        'placeholder'=>"Nombre de tours que compte le Grand Prix"
                    ]
                ])
                ->add('km', TextType::class, [
                    'label' => 'Longueur',
                    'attr' => [
                        'placeholder'=>"Longueur du circuit"
                    ]
                ])
                ->add('turns', IntegerType::class, [
                    'label' => 'Virages',
                    'attr' => [
                        'placeholder'=>"Nombre de virages que compte le Grand Prix"
                    ]
                ]);

           
           
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GrandPrix::class
        ]);
    }
}
