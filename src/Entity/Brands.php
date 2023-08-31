<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BrandsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BrandsRepository::class)]
#[ApiResource(
    operations : []
)]
class Brands
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('products:read')]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups('products:read')]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Undocumented function.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Undocumented function.
     */
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
