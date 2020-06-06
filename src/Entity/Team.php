<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TeamRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $moteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity=Pilote::class, mappedBy="team")
     */
    private $pilotes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=Stats::class, mappedBy="team", orphanRemoval=true)
     */
    private $stats;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cover;

    /**
     * @ORM\Column(type="integer")
     */
    private $champion;
    
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
            $this->slug = $slugify->slugify($this->nom);
        }

    }

    public function __construct()
    {
        $this->pilotes = new ArrayCollection();
        $this->stats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMoteur(): ?string
    {
        return $this->moteur;
    }

    public function setMoteur(string $moteur): self
    {
        $this->moteur = $moteur;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection|Pilote[]
     */
    public function getPilotes(): Collection
    {
        return $this->pilotes;
    }

    public function addPilote(Pilote $pilote): self
    {
        if (!$this->pilotes->contains($pilote)) {
            $this->pilotes[] = $pilote;
            $pilote->setTeam($this);
        }

        return $this;
    }

    public function removePilote(Pilote $pilote): self
    {
        if ($this->pilotes->contains($pilote)) {
            $this->pilotes->removeElement($pilote);
            // set the owning side to null (unless already changed)
            if ($pilote->getTeam() === $this) {
                $pilote->setTeam(null);
            }
        }

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

    /**
     * @return Collection|Stats[]
     */
    public function getStats(): Collection
    {
        return $this->stats;
    }

    public function addStat(Stats $stat): self
    {
        if (!$this->stats->contains($stat)) {
            $this->stats[] = $stat;
            $stat->setTeam($this);
        }

        return $this;
    }

    public function removeStat(Stats $stat): self
    {
        if ($this->stats->contains($stat)) {
            $this->stats->removeElement($stat);
            // set the owning side to null (unless already changed)
            if ($stat->getTeam() === $this) {
                $stat->setTeam(null);
            }
        }

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getChampion(): ?int
    {
        return $this->champion;
    }

    public function setChampion(int $champion): self
    {
        $this->champion = $champion;

        return $this;
    }
}
