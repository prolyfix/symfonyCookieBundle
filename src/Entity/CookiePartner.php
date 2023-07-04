<?php

namespace Prolyfix\SymfonyCookieNotificationBundle\Entity;

use Prolyfix\SymfonyCookieNotificationBundle\Repository\CookiePartnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CookiePartnerRepository::class)]
class CookiePartner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'partner', targetEntity: CookieScript::class)]
    private Collection $cookieScripts;

    public function __construct()
    {
        $this->cookieScripts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $cookieScript->setPartner($this);
        }

        return $this;
    }

    public function removeCookieScript(CookieScript $cookieScript): static
    {
        if ($this->cookieScripts->removeElement($cookieScript)) {
            // set the owning side to null (unless already changed)
            if ($cookieScript->getPartner() === $this) {
                $cookieScript->setPartner(null);
            }
        }

        return $this;
    }
}
