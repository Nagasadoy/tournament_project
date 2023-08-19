<?php

namespace App\Repository;

use App\Entity\TeamMatch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TeamMatch>
 *
 * @method TeamMatch|null find($id, $lockMode = null, $lockVersion = null)
 * @method TeamMatch|null findOneBy(array $criteria, array $orderBy = null)
 * @method TeamMatch[]    findAll()
 * @method TeamMatch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamMatchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TeamMatch::class);
    }

//    /**
//     * @return TeamMatch[] Returns an array of TeamMatch objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TeamMatch
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
