<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
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
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity=ProviderHotel::class, mappedBy="ville")
     */
    private $providerHotels;

    public function __construct()
    {
        $this->providerHotels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection|ProviderHotel[]
     */
    public function getProviderHotels(): Collection
    {
        return $this->providerHotels;
    }

    public function addProviderHotel(ProviderHotel $providerHotel): self
    {
        if (!$this->providerHotels->contains($providerHotel)) {
            $this->providerHotels[] = $providerHotel;
            $providerHotel->setVille($this);
        }

        return $this;
    }

    public function removeProviderHotel(ProviderHotel $providerHotel): self
    {
        if ($this->providerHotels->contains($providerHotel)) {
            $this->providerHotels->removeElement($providerHotel);
            // set the owning side to null (unless already changed)
            if ($providerHotel->getVille() === $this) {
                $providerHotel->setVille(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->ville;
    }
}
