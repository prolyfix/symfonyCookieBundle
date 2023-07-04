<?php

namespace Prolyfix\SymfonyCookieNotificationBundle\Entity;

use Prolyfix\SymfonyCookieNotificationBundle\Repository\CookieNotificationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CookieNotificationRepository::class)]
class CookieNotification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $cookieConsentKey = null;

    #[ORM\Column]
    private ?bool $cookieValidation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endValidationDate = null;

    #[ORM\ManyToOne(inversedBy: 'cookieNotifications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CookieCategory $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCookieConsentKey(): ?string
    {
        return $this->cookieConsentKey;
    }

    public function setCookieConsentKey(string $cookieConsentKey): static
    {
        $this->cookieConsentKey = $cookieConsentKey;

        return $this;
    }

    public function isCookieValidation(): ?bool
    {
        return $this->cookieValidation;
    }

    public function setCookieValidation(bool $cookieValidation): static
    {
        $this->cookieValidation = $cookieValidation;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): static
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getEndValidationDate(): ?\DateTimeInterface
    {
        return $this->endValidationDate;
    }

    public function setEndValidationDate(?\DateTimeInterface $endValidationDate): static
    {
        $this->endValidationDate = $endValidationDate;

        return $this;
    }

    public function getCategory(): ?CookieCategory
    {
        return $this->category;
    }

    public function setCategory(?CookieCategory $category): static
    {
        $this->category = $category;

        return $this;
    }
}
