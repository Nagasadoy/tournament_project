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

    public function deleteAllMatchesByTournamentId(int $tournamentId): void
    {
        $ids = $this->createQueryBuilder('m')
            ->join('m.tournament', 't')
            ->where('t.id = :id')
            ->setParameter('id', $tournamentId)
            ->getQuery()
            ->getResult();

        $this->createQueryBuilder('m')
            ->delete()
            ->where('m.id in (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->execute();
    }
}
