<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Provider
 *
 * @ORM\Table(name="provider")
 * @ORM\Entity
 */
class Provider
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="provider_ref", type="boolean", nullable=true, options={"default"="NULL"})
     */
    private $providerRef = 'NULL';



    /**
     * @ORM\Column(name="tel", type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Adress;

    /**
     * @ORM\OneToMany(targetEntity=ProviderHotel::class, mappedBy="provide")
     */
    private $providerHotels;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->providerHotel = new \Doctrine\Common\Collections\ArrayCollection();
        $this->providerHotels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getProviderRef(): ?bool
    {
        return $this->providerRef;
    }

    public function setProviderRef(?bool $providerRef): self
    {
        $this->providerRef = $providerRef;

        return $this;
    }
    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->Adress;
    }

    public function setAdress(string $Adress): self
    {
        $this->Adress = $Adress;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
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
            $providerHotel->setProvide($this);
        }

        return $this;
    }

    public function removeProviderHotel(ProviderHotel $providerHotel): self
    {
        if ($this->providerHotels->contains($providerHotel)) {
            $this->providerHotels->removeElement($providerHotel);
            // set the owning side to null (unless already changed)
            if ($providerHotel->getProvide() === $this) {
                $providerHotel->setProvide(null);
            }
        }

        return $this;
    }
}
