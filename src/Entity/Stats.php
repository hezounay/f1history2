<?php

namespace App\Entity;

use App\Entity\Team;
use App\Entity\Pilote;
use App\Entity\GrandPrix;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\StatsRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;



/**
 * @ORM\Entity(repositoryClass=StatsRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @ApiResource(
 * normalizationContext={
 * "groups"={"stats_read"}
 * })
 * @ApiFilter(OrderFilter::class)
 * @ApiFilter(SearchFilter::class)
 */
class Stats
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Pilote::class, inversedBy="stats")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"stats_read","grandprix_read"})
     * 
     */
    private $pilote;

    /**
     * @ORM\ManyToOne(targetEntity=GrandPrix::class, inversedBy="stats")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"pilote_read"})
     * 
     */
    private $grandPrix;

 

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="stats")
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity=GrandPrix::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"stats_read"})
     * 
     *
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"stats_read","pilote_read","grandprix_read"})
     *
     */
    private $chrono;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"stats_read","pilote_read","grandprix_read"})
     * 
     */
    private $kmh;



    /**
     * Permet d'intialiser le slug
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function initializeSlug(){
        if(empty($this->slug)){
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->id);
        }

    }
  

    public function getId(): ?int
    {
        return $this->id;
    }

   


   

    public function getPilote(): ?Pilote
    {
        return $this->pilote;
    }

    public function setPilote(?Pilote $pilote): self
    {
        $this->pilote = $pilote;

        return $this;
    }

    public function getGrandPrix(): ?GrandPrix
    {
        return $this->grandPrix;
    }

    public function setGrandPrix(?GrandPrix $grandPrix): self
    {
        $this->grandPrix = $grandPrix;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getDate(): ?GrandPrix
    {
        return $this->date;
    }

    public function setDate(?GrandPrix $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getChrono(): ?string
    {
        return $this->chrono;
    }

    public function setChrono(string $chrono): self
    {
        $this->chrono = $chrono;

        return $this;
    }

    public function getKmh(): ?string
    {
        return $this->kmh;
    }

    public function setKmh(string $kmh): self
    {
        $this->kmh = $kmh;

        return $this;
    }

    
}
