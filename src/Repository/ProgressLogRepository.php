<?php

namespace App\Repository;

use App\Entity\ProgressLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProgressLog>
 */
class ProgressLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProgressLog::class);
    }

        public function otherActivitiesByYear(string $value): array
        {
            $start = new \DateTime($value."-01-01");
            $finish = new \DateTime( $value ."-12-31");

            return $this->createQueryBuilder('p')
                ->andWhere('p.finishDate < :finish')
                ->andWhere('p.finishDate > :start')
                ->setParameter('finish', $finish)
                ->setParameter('start', $start)
                ->getQuery()
                ->getResult()
            ;
        }

    //    public function findOneBySomeField($value): ?ProgressLog
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
