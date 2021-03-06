<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProviderHotelImgRepository")
 */
class ProviderHotelImg
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
    private $img;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProviderHotel", inversedBy="providerHotelImgs")
     */
    private $providerhotels;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

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
        return $this->img;
    }  

}
