<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\StatsRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=StatsRepository::class)
 * @ORM\HasLifecycleCallbacks
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
     */
    private $pilote;

    /**
     * @ORM\ManyToOne(targetEntity=GrandPrix::class, inversedBy="stats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $grandPrix;

 

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="stats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity=GrandPrix::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $chrono;

    /**
     * @ORM\Column(type="string", length=255)
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
