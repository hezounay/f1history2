<?php

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;





/**
 * @ORM\Entity(repositoryClass=GrandPrixRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class GrandPrixPhotoEdit
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
    private $cover;

     /**
     * Variable utilisé dans le formulaire pour la réception du fichier
     * @Assert\Image(mimeTypes={"image/png","image/jpeg","image/gif"}, mimeTypesMessage="Vous devez upload un fichier jpg, png ou gif")
     * @Assert\File(maxSize="1024k", maxSizeMessage="taille du fichier trop grande")
     */
    private $map;

 


    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }
   
    public function getMap(): ?string
    {
        return $this->map;
    }

    public function setMap(string $map): self
    {
        $this->map = $map;

        return $this;
    }
}