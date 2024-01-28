<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $reference = null;

    #[ORM\Column(length: 150)]
    private ?string $designation = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?Epaisseurs $epaisseur = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?Dimensions $dimension = null;

    #[ORM\OneToMany(mappedBy: 'products', targetEntity: Stock::class)]
    private Collection $stocks;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?OrigineProduit $origine = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?TypeProduit $type = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2, nullable: true)]
    private ?string $prixVente = null;

    public function __construct()
    {
        // $this->ordersDetails = new ArrayCollection();
        $this->stocks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return trim(strtoupper($this->reference));
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return trim(ucwords($this->designation));
    }

    public function setDesignation(string $designation): static
    {
        $this->designation = $designation;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getEpaisseur(): ?Epaisseurs
    {
        return $this->epaisseur;
    }

    public function setEpaisseur(?Epaisseurs $epaisseur): static
    {
        $this->epaisseur = $epaisseur;

        return $this;
    }

    public function getDimension(): ?Dimensions
    {
        return $this->dimension;
    }

    public function setDimension(?Dimensions $dimension): static
    {
        $this->dimension = $dimension;

        return $this;
    }

    /**
     * @return Collection<int, Stock>
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): static
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks->add($stock);
            $stock->setProducts($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): static
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getProducts() === $this) {
                $stock->setProducts(null);
            }
        }

        return $this;
    }

    public function getOrigine(): ?OrigineProduit
    {
        return $this->origine;
    }

    public function setOrigine(?OrigineProduit $origine): static
    {
        $this->origine = $origine;

        return $this;
    }

    public function getType(): ?TypeProduit
    {
        return $this->type;
    }

    public function setType(?TypeProduit $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPrixVente(): ?string
    {
        return $this->prixVente;
    }

    public function setPrixVente(?string $prixVente): static
    {
        $this->prixVente = $prixVente;

        return $this;
    }
}
