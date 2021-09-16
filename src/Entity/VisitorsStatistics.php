<?php

namespace App\Entity;

use App\Repository\VisitorsStatisticsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VisitorsStatisticsRepository::class)
 */
class VisitorsStatistics
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
    private $ip_address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $browser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $route;

    /**
     * @ORM\Column(type="datetime")
     */
    private $visited_at;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBrowser(): ?string
    {
        return $this->browser;
    }

    public function setBrowser(string $browser): self
    {
        $this->browser = $browser;

        return $this;
    }

    public function getRoute(): ?string
    {
        return $this->route;
    }

    public function setRoute(string $route): self
    {
        $this->route = $route;

        return $this;
    }

    public function getVisitedAt(): ?\DateTimeInterface
    {
        return $this->visited_at;
    }

    public function setVisitedAt(\DateTimeInterface $visited_at): self
    {
        $this->visited_at = $visited_at;

        return $this;
    }
}
