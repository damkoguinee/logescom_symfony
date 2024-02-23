<?php

namespace App\Entity;

use App\Entity\Stock;
use App\Entity\LiaisonProduit;
use Doctrine\DBAL\Types\Types;
use App\Entity\MouvementProduct;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[ORM\Entity(repositoryClass: ProductsRepository::class)]
#[UniqueEntity(fields: ['reference'], message: 'La référence doit être unique.')]
#[UniqueEntity(fields: ['designation'], message: 'La désignation doit être unique.')]
#[UniqueEntity(fields: ['codeBarre'], message: 'Le code barre doit être unique.', ignoreNull: true)]
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

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?OrigineProduit $origine = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?TypeProduit $type = null;

    #[ORM\OneToMany(mappedBy: 'products', targetEntity: Stock::class)]
    private Collection $stocks;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2, nullable: true)]
    private ?string $prixVente = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: MouvementProduct::class)]
    private Collection $mouvementProducts;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codeBarre = null;

    #[ORM\Column(nullable: true)]
    private ?float $nbrePiece = null;

    #[ORM\Column(nullable: true)]
    private ?float $nbrePaquet = null;

    #[ORM\Column(length: 15)]
    private ?string $typeProduit = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbreVente = null;

    #[ORM\Column(length: 10)]
    private ?string $statut = null;

    #[ORM\Column(length: 10)]
    private ?string $statutComptable = null;

    #[ORM\Column(nullable: true)]
    private ?float $tva = null;

    #[ORM\OneToMany(mappedBy: 'produit1', targetEntity: LiaisonProduit::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $liaisonProduit1;

    #[ORM\OneToMany(mappedBy: 'produit2', targetEntity: LiaisonProduit::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $liaisonProduit2;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Inventaire::class)]
    private Collection $inventaires;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: AnomalieProduit::class)]
    private Collection $anomalieProduits;

    public function __construct()
    {
        // $this->ordersDetails = new ArrayCollection();
        $this->stocks = new ArrayCollection();
        $this->mouvementProducts = new ArrayCollection();
        $this->liaisonProduit1 = new ArrayCollection();
        $this->liaisonProduit2 = new ArrayCollection();
        $this->inventaires = new ArrayCollection();
        $this->anomalieProduits = new ArrayCollection();
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

    /**
     * @return Collection<int, MouvementProduct>
     */
    public function getMouvementProducts(): Collection
    {
        return $this->mouvementProducts;
    }

    public function addMouvementProduct(MouvementProduct $mouvementProduct): static
    {
        if (!$this->mouvementProducts->contains($mouvementProduct)) {
            $this->mouvementProducts->add($mouvementProduct);
            $mouvementProduct->setProduct($this);
        }

        return $this;
    }

    public function removeMouvementProduct(MouvementProduct $mouvementProduct): static
    {
        if ($this->mouvementProducts->removeElement($mouvementProduct)) {
            // set the owning side to null (unless already changed)
            if ($mouvementProduct->getProduct() === $this) {
                $mouvementProduct->setProduct(null);
            }
        }

        return $this;
    }

    public function getCodeBarre(): ?string
    {
        return $this->codeBarre;
    }

    public function setCodeBarre(?string $codeBarre): static
    {
        $this->codeBarre = $codeBarre;

        return $this;
    }

    public function getNbrePiece(): ?float
    {
        return $this->nbrePiece;
    }

    public function setNbrePiece(?float $nbrePiece): static
    {
        $this->nbrePiece = $nbrePiece;

        return $this;
    }

    public function getNbrePaquet(): ?float
    {
        return $this->nbrePaquet;
    }

    public function setNbrePaquet(?float $nbrePaquet): static
    {
        $this->nbrePaquet = $nbrePaquet;

        return $this;
    }

    public function getTypeProduit(): ?string
    {
        return $this->typeProduit;
    }

    public function setTypeProduit(?string $typeProduit): static
    {
        $this->typeProduit = $typeProduit;

        return $this;
    }

    public function getNbreVente(): ?int
    {
        return $this->nbreVente;
    }

    public function setNbreVente(?int $nbreVente): static
    {
        $this->nbreVente = $nbreVente;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getStatutComptable(): ?string
    {
        return $this->statutComptable;
    }

    public function setStatutComptable(string $statutComptable): static
    {
        $this->statutComptable = $statutComptable;

        return $this;
    }

    public function getTva(): ?float
    {
        return $this->tva;
    }

    public function setTva(?float $tva): static
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * @return Collection<int, LiaisonProduit>
     */
    public function getLiaisonProduit1(): Collection
    {
        return $this->liaisonProduit1;
    }

    public function addLiaisonProduit1(LiaisonProduit $liaisonProduit1): static
    {
        if (!$this->liaisonProduit1->contains($liaisonProduit1)) {
            $this->liaisonProduit1->add($liaisonProduit1);
            $liaisonProduit1->setProduit1($this);
        }

        return $this;
    }

    public function removeLiaisonProduit1(LiaisonProduit $liaisonProduit1): static
    {
        if ($this->liaisonProduit1->removeElement($liaisonProduit1)) {
            // set the owning side to null (unless already changed)
            if ($liaisonProduit1->getProduit1() === $this) {
                $liaisonProduit1->setProduit1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LiaisonProduit>
     */
    public function getLiaisonProduit2(): Collection
    {
        return $this->liaisonProduit2;
    }

    public function addLiaisonProduit2(LiaisonProduit $liaisonProduit2): static
    {
        if (!$this->liaisonProduit2->contains($liaisonProduit2)) {
            $this->liaisonProduit2->add($liaisonProduit2);
            $liaisonProduit2->setProduit2($this);
        }

        return $this;
    }

    public function removeLiaisonProduit2(LiaisonProduit $liaisonProduit2): static
    {
        if ($this->liaisonProduit2->removeElement($liaisonProduit2)) {
            // set the owning side to null (unless already changed)
            if ($liaisonProduit2->getProduit2() === $this) {
                $liaisonProduit2->setProduit2(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Inventaire>
     */
    public function getInventaires(): Collection
    {
        return $this->inventaires;
    }

    public function addInventaire(Inventaire $inventaire): static
    {
        if (!$this->inventaires->contains($inventaire)) {
            $this->inventaires->add($inventaire);
            $inventaire->setProduct($this);
        }

        return $this;
    }

    public function removeInventaire(Inventaire $inventaire): static
    {
        if ($this->inventaires->removeElement($inventaire)) {
            // set the owning side to null (unless already changed)
            if ($inventaire->getProduct() === $this) {
                $inventaire->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AnomalieProduit>
     */
    public function getAnomalieProduits(): Collection
    {
        return $this->anomalieProduits;
    }

    public function addAnomalieProduit(AnomalieProduit $anomalieProduit): static
    {
        if (!$this->anomalieProduits->contains($anomalieProduit)) {
            $this->anomalieProduits->add($anomalieProduit);
            $anomalieProduit->setProduct($this);
        }

        return $this;
    }

    public function removeAnomalieProduit(AnomalieProduit $anomalieProduit): static
    {
        if ($this->anomalieProduits->removeElement($anomalieProduit)) {
            // set the owning side to null (unless already changed)
            if ($anomalieProduit->getProduct() === $this) {
                $anomalieProduit->setProduct(null);
            }
        }

        return $this;
    }

    
}
