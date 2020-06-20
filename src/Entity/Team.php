<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TeamRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @ApiResource(
 *  normalizationContext={
 * "groups"={"team_read"}
 * })
 * @ApiFilter(OrderFilter::class)
 * @ApiFilter(SearchFilter::class)
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"team_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"pilote_read","stats_read","grandprix_read","team_read"})
     * @Assert\NotBlank(message="Vous devez renseigner le nom de l'Ecurie")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"pilote_read","stats_read","team_read"})
     * @Assert\NotBlank(message="Vous devez renseigner le moteur de l'Ecurie")
     */
    private $moteur;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"team_read"})
     * 
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity=Pilote::class, mappedBy="team")
     * @Groups({"team_read"})
     *
     */
    private $pilotes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=Stats::class, mappedBy="team", orphanRemoval=true)
     * 
     */
    private $stats;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"team_read", "pilote_read"})
     */
    private $cover;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"team_read"})
     */
    private $champion;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"team_read"})
     */
    private $poles;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"team_read"})
     */
    private $championpilote;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"team_read"})
     */
    private $wins;


    
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

    public function getPoles(): ?int
    {
        return $this->poles;
    }

    public function setPoles(int $poles): self
    {
        $this->poles = $poles;

        return $this;
    }

    public function getChampionpilote(): ?int
    {
        return $this->championpilote;
    }

    public function setChampionpilote(int $championpilote): self
    {
        $this->championpilote = $championpilote;

        return $this;
    }

    public function getWins(): ?int
    {
        return $this->wins;
    }

    public function setWins(int $wins): self
    {
        $this->wins = $wins;

        return $this;
    }


}
