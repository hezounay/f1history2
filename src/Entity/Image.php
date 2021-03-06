<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ImageRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 * @ApiResource
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ApiFilter(OrderFilter::class)
     * @ApiFilter(SearchFilter::class)
     */
    private $id;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $caption;

    /**
     * @ORM\ManyToOne(targetEntity=GrandPrix::class, inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $grandprix;

        /**
     * Variable utilisé dans le formulaire pour la réception du fichier
     * @Assert\Image(mimeTypes={"image/png","image/jpeg","image/gif"}, mimeTypesMessage="Vous devez upload un fichier jpg, png ou gif")
     * @Assert\File(maxSize="1024k", maxSizeMessage="taille du fichier trop grande")
     */
    private $url;


  

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }



    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function getGrandprix(): ?GrandPrix
    {
        return $this->grandprix;
    }

    public function setGrandprix(?GrandPrix $grandprix): self
    {
        $this->grandprix = $grandprix;

        return $this;
    }
}
