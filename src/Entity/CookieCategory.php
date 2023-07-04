<?php

namespace Prolyfix\SymfonyCookieNotificationBundle\Entity;

use Prolyfix\SymfonyCookieNotificationBundle\Repository\CookieCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CookieCategoryRepository::class)]
class CookieCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: CookieScript::class)]
    private Collection $cookieScripts;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: CookieNotification::class)]
    private Collection $cookieNotifications;

    public function __construct()
    {
        $this->cookieScripts = new ArrayCollection();
        $this->cookieNotifications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

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

    /**
     * @return Collection<int, CookieScript>
     */
    public function getCookieScripts(): Collection
    {
        return $this->cookieScripts;
    }

    public function addCookieScript(CookieScript $cookieScript): static
    {
        if (!$this->cookieScripts->contains($cookieScript)) {
            $this->cookieScripts->add($cookieScript);
            $cookieScript->setCategory($this);
        }

        return $this;
    }

    public function removeCookieScript(CookieScript $cookieScript): static
    {
        if ($this->cookieScripts->removeElement($cookieScript)) {
            // set the owning side to null (unless already changed)
            if ($cookieScript->getCategory() === $this) {
                $cookieScript->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CookieNotification>
     */
    public function getCookieNotifications(): Collection
    {
        return $this->cookieNotifications;
    }

    public function addCookieNotification(CookieNotification $cookieNotification): static
    {
        if (!$this->cookieNotifications->contains($cookieNotification)) {
            $this->cookieNotifications->add($cookieNotification);
            $cookieNotification->setCategory($this);
        }

        return $this;
    }

    public function removeCookieNotification(CookieNotification $cookieNotification): static
    {
        if ($this->cookieNotifications->removeElement($cookieNotification)) {
            // set the owning side to null (unless already changed)
            if ($cookieNotification->getCategory() === $this) {
                $cookieNotification->setCategory(null);
            }
        }

        return $this;
    }
}
