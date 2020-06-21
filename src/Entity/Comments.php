<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;


use App\Repository\CommentsRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;



/**
 * @ORM\Entity(repositoryClass=CommentsRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @ApiResource(
 *  normalizationContext={
 * "groups"={"comments_read"}
 * }))
 * @ApiFilter(OrderFilter::class)
 * @ApiFilter(SearchFilter::class)
 */
class Comments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"grandprix_read","comments_read"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"grandprix_read","comments_read"})
     */
    private $rating;

    /**
     * @ORM\Column(type="text")
     * @Groups({"grandprix_read","comments_read"})
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=GrandPrix::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"user_read","comments_read"})
     */
    private $grandPrix;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"grandprix_read","comments_read"})
     */
    private $author;


    /**
     * Permet de mettre en place la date de création
     * @ORM\PrePersist
     *
     * @return void
     */
    public function prePersist(){
        if(empty($this->createdAt)){
            $this->createdAt = new \DateTime();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }
}
