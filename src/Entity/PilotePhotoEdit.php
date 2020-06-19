<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;






/**
 * @ORM\Entity(repositoryClass=PiloteRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @ApiResource
 * @ApiFilter(OrderFilter::class)
 * @ApiFilter(SearchFilter::class)
 */
class PilotePhotoEdit
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * Variable utilisé dans le formulaire pour la réception du fichier
     * @Assert\Image(mimeTypes={"image/png","image/jpeg","image/gif"}, mimeTypesMessage="Vous devez upload un fichier jpg, png ou gif")
     * @Assert\File(maxSize="1024k", maxSizeMessage="taille du fichier trop grande")
     */
    private $picture;



 


    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
   
}