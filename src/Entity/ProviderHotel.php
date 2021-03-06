<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ProviderHotel
 *
 * @ORM\Table(name="provider_hotel")
 * @ORM\Entity(repositoryClass="App\Repository\ProviderHotelRepository")
 */
class ProviderHotel
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
     * @ORM\Column(name="category", type="string", length=255, nullable=true)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=0, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="providerHotels")
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity=Provider::class, inversedBy="providerHotels")
     */
    private $provide;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $refe;






    /**
     * Constructor
     */
    public function __construct()
    {
        $this->provider = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ref = new ArrayCollection();
        $this->providerHotelPrixes = new ArrayCollection();
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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getProvide(): ?Provider
    {
        return $this->provide;
    }

    public function setProvide(?Provider $provide): self
    {
        $this->provide = $provide;

        return $this;
    }

    public function getRefe(): ?int
    {
        return $this->refe;
    }

    public function setRefe(?int $refe): self
    {
        $this->refe = $refe;

        return $this;
    }

    







}
