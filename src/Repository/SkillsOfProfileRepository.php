<?php

namespace App\Repository;

use App\Entity\SkillsOfProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SkillsOfProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method SkillsOfProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method SkillsOfProfile[]    findAll()
 * @method SkillsOfProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkillsOfProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SkillsOfProfile::class);
    }

    // /**
    //  * @return SkillsOfProfile[] Returns an array of SkillsOfProfile objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SkillsOfProfile
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
