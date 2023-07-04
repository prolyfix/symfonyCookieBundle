<?php

namespace Prolyfix\SymfonyCookieNotificationBundle\Entity;

use Prolyfix\SymfonyCookieNotificationBundle\Repository\CookieScriptRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CookieScriptRepository::class)]
class CookieScript
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cookieScripts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CookieCategory $category = null;

    #[ORM\ManyToOne(inversedBy: 'cookieScripts')]
    private ?CookiePartner $partner = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $script = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPartner(): ?CookiePartner
    {
        return $this->partner;
    }

    public function setPartner(?CookiePartner $partner): static
    {
        $this->partner = $partner;

        return $this;
    }

    public function getScript(): ?string
    {
        return $this->script;
    }

    public function setScript(string $script): static
    {
        $this->script = $script;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
