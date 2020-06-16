<?php

namespace App\Entity;

use App\Entity\Stats;
use Cocur\Slugify\Slugify;



use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GrandPrixRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity(repositoryClass=GrandPrixRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class GrandPrix
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Image(mimeTypes={"image/png","image/jpeg","image/gif"}, mimeTypesMessage="Vous devez upload un fichier jpg, png ou gif", groups={"front"})
     * @Assert\File(maxSize="1024k", maxSizeMessage="taille du fichier trop grande", groups={"front"})
     */
    private $map;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Stats::class, mappedBy="grandPrix")
     */
    private $stats;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="grandprix", orphanRemoval=true)
     */
    private $images;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Image(mimeTypes={"image/png","image/jpeg","image/gif"}, mimeTypesMessage="Vous devez upload un fichier jpg, png ou gif", groups={"front"})
     * @Assert\File(maxSize="1024k", maxSizeMessage="taille du fichier trop grande", groups={"front"})
     */
    private $cover;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $km;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $laps;

    /**
     * @ORM\Column(type="integer")
     */
    private $turns;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="grandPrix")
     */
    private $comments;



    public function __construct()
    {

        $this->stats = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->comments = new ArrayCollection();
       
    }
    
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
            $this->slug = $slugify->slugify($this->title.''.$this->date);
        }

    }

    public function getPodium() {
       
       

    
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDate():  ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

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

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
            $stat->setGrandPrix($this);
        }

        return $this;
    }

    public function removeStat(Stats $stat): self
    {
        if ($this->stats->contains($stat)) {
            $this->stats->removeElement($stat);
            // set the owning side to null (unless already changed)
            if ($stat->getGrandPrix() === $this) {
                $stat->setGrandPrix(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setGrandprix($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getGrandprix() === $this) {
                $image->setGrandprix(null);
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

    public function getKm(): ?string
    {
        return $this->km;
    }

    public function setKm(string $km): self
    {
        $this->km = $km;

        return $this;
    }

    public function getLaps(): ?string
    {
        return $this->laps;
    }

    public function setLaps(string $laps): self
    {
        $this->laps = $laps;

        return $this;
    }

    public function getTurns(): ?int
    {
        return $this->turns;
    }

    public function setTurns(int $turns): self
    {
        $this->turns = $turns;

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setGrandPrix($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getGrandPrix() === $this) {
                $comment->setGrandPrix(null);
            }
        }

        return $this;
    }
      /**
     * Permet de récupérer la note globale du Grand Prix
     *
     * @return float
     */
    public function getAvgRatings(){
        // calculer la somme des notations
        // la fonction php array_reduce permet de réduire le tableau à une seule valeur (attention il faut un tableau pas une array collection d'où le toArray() - 2ème paramètre pour la fonction pour chaque valeur - 3ème param valeur par défaut )
        $sum = array_reduce($this->comments->toArray(), function($total, $comment){
            return $total + $comment->getRating();
        },0);

        // faire la division pour avoir la moyenne

        if(count($this->comments) > 0 ) return $moyenne = round($sum / count($this->comments));

        return 0;

    }

    /**
     * Permet de récupérer le commentaire d'un client par rapport à une chambre
     *
     * @param User $author
     * @return Comment|null
     */
    public function getCommentFromAuthor(User $author){
        foreach($this->comments as $comment){
            if($comment->getAuthor() === $author) return $comment;
        }

        return null;
    }

   
}
