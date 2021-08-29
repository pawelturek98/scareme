<?php

namespace App\Entity;

use App\Repository\RatingsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RatingsRepository::class)
 */
class Ratings
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ip_address;

    /**
     * @ORM\Column(type="datetime")
     */
    private $rating_date;

    /**
     * @ORM\ManyToOne(targetEntity=Posts::class, inversedBy="ratings")
     */
    private $post_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getIpAddress(): ?string
    {
        return $this->ip_address;
    }

    public function setIpAddress(string $ip_address): self
    {
        $this->ip_address = $ip_address;

        return $this;
    }

    public function getRatingDate(): ?\DateTimeInterface
    {
        return $this->rating_date;
    }

    public function setRatingDate(\DateTimeInterface $rating_date): self
    {
        $this->rating_date = $rating_date;

        return $this;
    }

    public function getPostId(): ?Posts
    {
        return $this->post_id;
    }

    public function setPostId(?Posts $post_id): self
    {
        $this->post_id = $post_id;

        return $this;
    }
}
