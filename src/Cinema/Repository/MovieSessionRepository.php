<?php

namespace App\Cinema\Repository;

use App\Cinema\Entity\MovieSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MovieSession>
 *
 * @method MovieSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method MovieSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method MovieSession[] findAll()
 * @method MovieSession[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class MovieSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MovieSession::class);
    }

    public function add(MovieSession $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MovieSession $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
