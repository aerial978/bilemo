<?php

namespace App\Repository;

use ApiPlatform\Doctrine\Orm\Paginator;
use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @extends ServiceEntityRepository<Users>
 *
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[]    findAll()
 * @method Users[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository
{
    public const ITEMS_PER_PAGE = 3;
    private $tokenStorage;

    public function __construct(ManagerRegistry $registry, TokenStorageInterface $tokenStorage)
    {
        parent::__construct($registry, Users::class);
        $this->tokenStorage = $tokenStorage;
    }

    public function save(Users $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Users $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /*
        public function findUsersByClientWithPagination($client, $page, $perPage)
        {
            // Créer une requête de constructeur de requête (QueryBuilder) pour la table des utilisateurs ('u')
            $qb = $this->createQueryBuilder('u')
                ->where('u.client = :client') // Ajouter une clause WHERE pour filtrer par le client
                ->setParameter('client', $client) // Définisser le paramètre ':client' avec la valeur du client

                ->orderBy('u.id', 'ASC'); // Trier les résultats par ID en ordre croissant

            // Obtener la requête DQL à partir du QueryBuilder
            $query = $qb->getQuery();

            // Créer un objet Paginator à partir de la requête
            $paginator = new Paginator($query);

            // Calculer l'offset (décalage) en fonction de la page actuelle et du nombre d'éléments par page
            $offset = ($page - 1) * $perPage;

            // Définisser le nombre maximal de résultats (éléments par page) et le premier résultat pour la pagination
            $paginator
                ->getQuery()
                ->setMaxResults($perPage)
                ->setFirstResult($offset);

            // Retourner l'objet Paginator contenant les résultats paginés
            return $paginator;
        }*/

    public function findUsersByClientWithPagination(int $page = 1): Paginator
    {
        $firstResult = ($page - 1) * self::ITEMS_PER_PAGE;

        $client = $this->tokenStorage->getToken()->getUser();
        $queryBuilder = $this->createQueryBuilder('u')
            ->where('u.client = :client')
            ->setParameter('client', $client)
            ->orderBy('u.id', 'ASC');

        $query = $queryBuilder->getQuery()
            ->setFirstResult($firstResult)
            ->setMaxResults(self::ITEMS_PER_PAGE);

        $doctrinePaginator = new DoctrinePaginator($query);
        $paginator = new Paginator($doctrinePaginator);

        return $paginator;
    }
}
