<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\CustomController;
use App\Entity\Traits\TimestampableEntityTrait;
use App\Repository\UsersRepository;
use App\ValidatorConstraint\UserValidator;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['read:Users']],
    operations: [
        new GetCollection(controller: CustomController::class),
        new Get(security: 'object.client == user', securityMessage: 'Error client'),
        new Post(denormalizationContext: ['groups' => ['post:Users', 'timestampable']]),
        new Delete(security: 'object.client == user', securityMessage: 'Error client'),
    ],
)]
#[UniqueEntity(fields: ['email'], message: 'This email is already used !')]
class Users
{
    /**
     * Hook timestampable behavior
     * updates createdAt, updatedAt fields.
     */
    use TimestampableEntityTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('read:Users')]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['read:Users', 'post:Users'])]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, minMessage: 'Please enter at least 2 characters !')]
    #[Assert\Callback([UserValidator::class, 'validateFirstName'])]
    private ?string $firstName = null;

    #[ORM\Column(length: 50)]
    #[Groups(['read:Users', 'post:Users'])]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, minMessage: 'Please enter at least 2 characters !')]
    #[Assert\Callback([UserValidator::class, 'validateLastName'])]
    private ?string $lastName = null;

    #[ORM\Column(length: 50, unique: true)]
    #[Groups(['read:Users', 'post:Users'])]
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column(length: 20)]
    #[Groups(['read:Users', 'post:Users'])]
    #[Assert\NotBlank]
    #[Assert\Callback([UserValidator::class, 'validatePhoneNumber'])]
    private ?string $phoneNumber = null;

    #[ORM\ManyToOne]
    #[ApiProperty(readable: true, writable: false)]
    #[Groups(['read:Users', 'post:Users'])]
    public ?Clients $client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getClient(): ?Clients
    {
        return $this->client;
    }

    public function setClient(?Clients $client): static
    {
        $this->client = $client;

        return $this;
    }
}
