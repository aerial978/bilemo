<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductsRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Metadata\GetCollection;
use App\DataProvider\ProductItemDataProvider;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['read:Products']],
    operations : [
        new GetCollection(),
        new Get(provider: ProductItemDataProvider::class),
    ]
)]
#[ApiFilter(OrderFilter::class, properties: ['model'])]
#[ApiFilter(SearchFilter::class, properties: ['model' => 'ipartial', 'color' => 'ipartial', 'screenSize' => 'ipartial'])]
#[ApiFilter(RangeFilter::class, properties: ['price'])]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('read:Products')]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups('read:Products')]
    private ?string $model = null;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    #[Gedmo\Slug(fields: ['model'])]
    #[Groups('read:Products')]
    private ?string $slug = null;

    #[ORM\Column]
    #[Groups('read:Products')]
    private ?float $price = null;

    #[ORM\Column(length: 25)]
    #[Groups('read:Products')]
    private ?string $color = null;

    #[ORM\Column(length: 50)]
    #[Groups('read:Products')]
    private ?string $screenSize = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToOne]
    #[Groups('read:Products')]
    private ?Brands $brand = null;

    #[ORM\ManyToOne]
    #[Groups('read:Products')]
    private ?Conditions $conditions = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getScreenSize(): ?string
    {
        return $this->screenSize;
    }

    public function setScreenSize(string $screenSize): static
    {
        $this->screenSize = $screenSize;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getBrand(): ?Brands
    {
        return $this->brand;
    }

    public function setBrand(?Brands $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getConditions(): ?Conditions
    {
        return $this->conditions;
    }

    public function setConditions(?Conditions $conditions): static
    {
        $this->conditions = $conditions;

        return $this;
    }
}
