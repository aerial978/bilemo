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
    #[Groups('read:Products')]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups('read:Products')]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
