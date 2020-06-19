<?php


namespace App\Form;

use App\Entity\Team;
use App\Entity\Pilote;
use App\Form\ImageType;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class PiloteType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder'=>"Prénom du Pilote"
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder'=>"Nom du Pilote"
                ]
            ])
            ->add('nationalite', CountryType::class, [
                'label' => 'Nationalité',
              ])
            ->add('datenaissance', BirthdayType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                'attr' => [
                    
                    'placeholder'=>"Date de naissance du Pilote"
                ]
            ])
            ->add('team', EntityType::class, [
                'label' => 'Ecurie',
                'attr' => [
                    'placeholder'=>"Ecurie du Pilote"
                ],
                'class' => Team::class,
                'choice_label' => function($team){
                    return $team->getNom();
                }
            ])
            ->add('picture', FileType::class, [
                'label' => 'Photo du Pilote',
                'attr' => [
                    'placeholder'=>"ajoutez l'URL de la photo du Pilote"
                ]
            ])
            ->add('actif', CheckboxType::class, [
                'label' => 'Activité',
                'required'=>false
                ]
                
            )
            ->add('poles', IntegerType::class, [
                'label' => 'Pole(s)',
                'attr' => [
                    'placeholder'=>"Nombre de pole(s) position"
                ]
            ])
            ->add('wins', IntegerType::class, [
                'label' => 'Victoire(s)',
                'attr' => [
                    'placeholder'=>"Nombre de victoire(s) "
                ]
            ])
            ->add('champion', IntegerType::class, [
                'label' => 'Titres(s)',
                'attr' => [
                    'placeholder'=>"Nombre de titre(s) de champion du monde"
                ]
            ]);
          
            

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pilote::class
        ]);
    }
}


