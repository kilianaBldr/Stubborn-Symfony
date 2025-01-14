<?php

namespace App\Entity;

use App\Repository\SweatshirtRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SweatshirtRepository::class)]
class Sweatshirt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type : 'integer')]
    private $id;

    #[ORM\Column(type : 'string', length: 255)]
    private $name;

    #[ORM\Column(type : 'float')]
    private $price;

    #[ORM\Column(type : 'boolean')]
    private $isFeatured;

    #[ORM\Column(type : 'json')]
    private $sizes = ['XS', 'S', 'M', 'L', 'XL'];

    #[ORM\Column(type : 'integer')]
    private $stock;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?int
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function isFeatured(): ?bool
    {
        return $this->isFeatured();
    }

    public function setIsFeatured(bool $isFeatured): self
    {
        $this->isFeatured = $isFeatured;
        return $this;
    }

    public function getSizes(): array
    {
        return $this->sizes;
    }

    public function setSizes(array $sizes): self
    {
        $this->sizes = $sizes;
        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;
        return $this;
    }
}
