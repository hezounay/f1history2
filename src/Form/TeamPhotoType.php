<?php

namespace App\Form;

use App\Form\ImageType;
use App\Entity\Pilote;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class TeamPhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
     
            ->add('cover', FileType::class, [
                'label' => "Photo de l'écurie",
                'attr' => [
                    'placeholder'=>"ajoutez la photo de l'écurie"
                ]
            ])
           
             ;
 
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
          
        ]);
    }
}
