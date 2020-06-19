<?php

namespace App\Form;

use App\Entity\Team;
use App\Entity\Pilote;
use App\Form\ImageType;
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



class TeamEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom', TextType::class, [
            'label' => 'Ecurie',
            'attr' => [
                'placeholder'=>"Nom de l'écurie"
            ]
          ])

            ->add('moteur', TextType::class, [
                'label' => 'Moteur',
                'attr' => [
                    'placeholder'=>"Moteur utilisé"
                ]
            ])
            ->add('pays', CountryType::class, [
                'label' => 'Nationalité',
              ])
            ->add('poles', IntegerType::class, [
                'label' => 'Pole(s) position',
                'attr' => [
                    'placeholder'=>"Nombre de pole(s) position"
                ]
            ])
            ->add('wins', IntegerType::class, [
                'label' => 'Victoire(s)',
                'attr' => [
                    'placeholder'=>"Nombre de victoire(s)"
                ]
            ])

            ->add('champion', IntegerType::class, [
                'label' => 'Titres(s) Constructeur',
                'attr' => [
                    'placeholder'=>"Nombre de titre(s) de champion des constructeurs"
                ]
            ])
            ->add('championpilote', IntegerType::class, [
                'label' => 'Titres(s) Pilote',
                'attr' => [
                    'placeholder'=>"Nombre de titre(s) de champion des pilotes"
                ]
            ]);

           
           
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Team::class
        ]);
    }
}
