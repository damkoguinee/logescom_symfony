<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nameCategorie = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $couverture = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Products::class)]
    private Collection $products;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Dimensions::class)]
    private Collection $dimensions;

    #[ORM\Column(type: "json", nullable: true)]
    private ?array $imgProduit = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $priorite = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->dimensions = new ArrayCollection();

        if ($this->couverture === null) {
            $this->couverture = 'defaut.jpg';
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategorie(): ?string
    {
        return trim(ucwords($this->nameCategorie));
    }

    public function setNameCategorie(string $nameCategorie): static
    {
        $this->nameCategorie = $nameCategorie;

        return $this;
    }

    public function getCouverture(): ?string
    {
        return $this->couverture;
    }

    public function setCouverture(?string $couverture): static
    {
        $this->couverture = $couverture;

        return $this;
    }

    /**
     * @return Collection<int, Products>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setCategorie($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): static
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCategorie() === $this) {
                $product->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Dimensions>
     */
    public function getDimensions(): Collection
    {
        return $this->dimensions;
    }

    public function addDimension(Dimensions $dimension): static
    {
        if (!$this->dimensions->contains($dimension)) {
            $this->dimensions->add($dimension);
            $dimension->setCategorie($this);
        }

        return $this;
    }

    public function removeDimension(Dimensions $dimension): static
    {
        if ($this->dimensions->removeElement($dimension)) {
            // set the owning side to null (unless already changed)
            if ($dimension->getCategorie() === $this) {
                $dimension->setCategorie(null);
            }
        }

        return $this;
    }

    public function getImgProduit(): ?array
    {
        return $this->imgProduit;
    }

    public function setImgProduit(?array $imgProduit): static
    {
        $this->imgProduit = $imgProduit;

        return $this;
    }

    public function getPriorite(): ?string
    {
        return $this->priorite;
    }

    public function setPriorite(?string $priorite): static
    {
        $this->priorite = $priorite;

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
}
