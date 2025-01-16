<?php

namespace App\Repository;

use App\Entity\Resource;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Resource>
 */
class ResourceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resource::class);
    }

    public function findByStarted(string $startYear): array
    {
        $startDate = new \DateTime($startYear . '-01-01');
        $finishDate = new \DateTime((string)(((int)$startYear + 1)) . '-01-01');
        return $this->createQueryBuilder('r')
            ->andWhere('(r.startDate > :start AND r.startDate < :finish AND r.finishDate IS NULL) OR (r.startDate IS NULL)')
            ->setParameter('start', $startDate)
            ->setParameter('finish', $finishDate)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByFinished(string $startYear): array
    {
        $startDate = new \DateTime($startYear . '-01-01');
        $finishDate = new \DateTime((string)(((int)$startYear + 1)) . '-01-01');
        return $this->createQueryBuilder('r')
            ->andWhere('(r.finishDate > :start AND r.finishDate < :finish AND r.finishDate IS NOT NULL)')
            ->setParameter('start', $startDate)
            ->setParameter('finish', $finishDate)
            ->getQuery()
            ->getResult()
            ;
    }
}
