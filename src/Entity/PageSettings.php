<?php

namespace App\Entity;

use App\Repository\PageSettingsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageSettingsRepository::class)
 */
class PageSettings
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
    private $page_name;

    /**
     * @ORM\Column(type="text")
     */
    private $page_description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $social_facebook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $social_instagram;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $social_youtube;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $social_discord;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $social_twitter;

    /**
     * @ORM\Column(type="boolean")
     */
    private $newsletter_enabled;

    /**
     * @ORM\Column(type="boolean")
     */
    private $show_most_popular_post;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPageName(): ?string
    {
        return $this->page_name;
    }

    public function setPageName(string $page_name): self
    {
        $this->page_name = $page_name;

        return $this;
    }

    public function getPageDescription(): ?string
    {
        return $this->page_description;
    }

    public function setPageDescription(string $page_description): self
    {
        $this->page_description = $page_description;

        return $this;
    }

    public function getSocialFacebook(): ?string
    {
        return $this->social_facebook;
    }

    public function setSocialFacebook(string $social_facebook): self
    {
        $this->social_facebook = $social_facebook;

        return $this;
    }

    public function getSocialInstagram(): ?string
    {
        return $this->social_instagram;
    }

    public function setSocialInstagram(?string $social_instagram): self
    {
        $this->social_instagram = $social_instagram;

        return $this;
    }

    public function getSocialYoutube(): ?string
    {
        return $this->social_youtube;
    }

    public function setSocialYoutube(?string $social_youtube): self
    {
        $this->social_youtube = $social_youtube;

        return $this;
    }

    public function getSocialDiscord(): ?string
    {
        return $this->social_discord;
    }

    public function setSocialDiscord(?string $social_discord): self
    {
        $this->social_discord = $social_discord;

        return $this;
    }

    public function getSocialTwitter(): ?string
    {
        return $this->social_twitter;
    }

    public function setSocialTwitter(?string $social_twitter): self
    {
        $this->social_twitter = $social_twitter;

        return $this;
    }

    public function getNewsletterEnabled(): ?bool
    {
        return $this->newsletter_enabled;
    }

    public function setNewsletterEnabled(bool $newsletter_enabled): self
    {
        $this->newsletter_enabled = $newsletter_enabled;

        return $this;
    }

    public function getShowMostPopularPost(): ?bool
    {
        return $this->show_most_popular_post;
    }

    public function setShowMostPopularPost(bool $show_most_popular_post): self
    {
        $this->show_most_popular_post = $show_most_popular_post;

        return $this;
    }
}
