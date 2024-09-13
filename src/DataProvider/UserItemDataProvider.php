<?php

namespace App\DataProvider;

use App\Repository\UsersRepository;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\SecurityBundle\Security;

final class UserItemDataProvider implements ProviderInterface
{
    private $repository;
    private $security;

    public function __construct(UsersRepository $repository, Security $security)
    {
        $this->repository = $repository;
        $this->security = $security;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): ?object
    {
        $userId = $uriVariables['id'] ?? null;

        $user = $this->repository->find($userId);

        if (!$user) {
            throw new NotFoundHttpException('The user does not exist !');
        }

        return $user;
    }
}
