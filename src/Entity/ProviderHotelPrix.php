<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProviderHotelPrixRepository")
 */
class ProviderHotelPrix
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
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_de_chambre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProviderHotel", inversedBy="providerHotelPrixes")
     */
    private $providerhotels;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getTypeDeChambre(): ?string
    {
        return $this->type_de_chambre;
    }

    public function setTypeDeChambre(string $type_de_chambre): self
    {
        $this->type_de_chambre = $type_de_chambre;

        return $this;
    }

    public function getProviderhotels(): ?ProviderHotel
    {
        return $this->providerhotels;
    }

    public function setProviderhotels(?ProviderHotel $providerhotels): self
    {
        $this->providerhotels = $providerhotels;

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

}
