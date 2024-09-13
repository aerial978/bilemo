<?php 

namespace App\DataProvider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\ProductsRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Entity\Products;

class ProductItemDataProvider implements ProviderInterface
{
    private $repository;

    public function __construct(ProductsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): ?Products
    {
        // Récupérer l'ID du produit à partir des variables d'URI
        $productId = $uriVariables['id'] ?? null;


        // Rechercher le produit dans la base de données
        $product = $this->repository->find($productId);

        // Si le produit n'est pas trouvé, lever une exception avec un message personnalisé
        if (!$product) {
            throw new NotFoundHttpException('The product does not exist !');
        }

        // Si le produit est trouvé, on le retourne
        return $product;
    }
}
