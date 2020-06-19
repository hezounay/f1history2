<?php

namespace App\Entity;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PiloteRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Stats;


/**
 * @ORM\Entity(repositoryClass=PiloteRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @ApiResource(
 * normalizationContext={
 * "groups"={"pilote_read"}
 * })
 * @ApiFilter(OrderFilter::class)
 * @ApiFilter(SearchFilter::class)
 */
class Pilote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"team_read","pilote_read","stats_read","grandprix_read"})
     * @Assert\NotBlank(message="Vous devez renseigner votre prénom")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"team_read","pilote_read","stats_read","grandprix_read"})
     * @Assert\NotBlank(message="Vous devez renseigner votre prénom")
     */
    private $prenom;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"pilote_read"})
     *
     */
    private $datenaissance;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"pilote_read","stats_read","grandprix_read"})
     *@Assert\NotBlank(message="Vous devez renseigner votre prénom")
     */
    private $nationalite;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"pilote_read"})
     *
     */
    private $actif;

    /**
     * @ORM\OneToMany(targetEntity=Stats::class, mappedBy="pilote", orphanRemoval=true)
     * @Groups({"pilote_read"})
     *
     */
    private $stats;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="pilotes")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"pilote_read","stats_read","grandprix_read"})
     *
     */
    private $team;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     
     * @ORM\Column(type="string", length=255)
     * @Assert\Image(mimeTypes={"image/png","image/jpeg","image/gif"}, mimeTypesMessage="Vous devez upload un fichier jpg, png ou gif", groups={"front"})
     * @Assert\File(maxSize="1024k", maxSizeMessage="taille du fichier trop grande", groups={"front"})
     * @Groups({"pilote_read","team_read"})
     */
    private $picture;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"pilote_read"})
     * @Assert\NotBlank(message="Vous devez renseigner votre prénom")
     */
    private $wins;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"pilote_read"})
     * @Assert\NotBlank(message="Vous devez renseigner votre prénom")
     */
    private $poles;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"pilote_read"})
     * @Assert\NotBlank(message="Vous devez renseigner votre prénom")
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
            $this->slug = $slugify->slugify($this->nom.' '.$this->prenom.' '.$this->team);
        }

    }

    public function __construct()
    {
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDatenaissance(): ?\DateTimeInterface
    {
        return $this->datenaissance;
    }

    public function setDatenaissance(\DateTimeInterface $datenaissance): self
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

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
            $stat->setPilote($this);
        }

        return $this;
    }

    public function removeStat(Stats $stat): self
    {
        if ($this->stats->contains($stat)) {
            $this->stats->removeElement($stat);
            // set the owning side to null (unless already changed)
            if ($stat->getPilote() === $this) {
                $stat->setPilote(null);
            }
        }

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

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

    public function getPoles(): ?int
    {
        return $this->poles;
    }

    public function setPoles(int $poles): self
    {
        $this->poles = $poles;

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
