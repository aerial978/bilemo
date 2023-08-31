<?php

namespace App\Repository;

use App\Entity\Conditions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Conditions>
 *
 * @method Conditions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conditions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conditions[]    findAll()
 * @method Conditions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConditionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conditions::class);
    }

    public function save(Conditions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Conditions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
