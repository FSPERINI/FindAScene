<?php

namespace App\Repository;

use App\Entity\Salles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Salles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Salles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Salles[]    findAll()
 * @method Salles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SallesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Salles::class);
    }

    public function search($query)
    {
        $qb = $this->createQueryBuilder('s')
            ->andWhere('s.ville LIKE :query')
            ->orWhere('s.nom_salle LIKE :query')
            ->setParameter('query', '%'.strtolower($query).'%')
            ->getQuery();

        return $qb->getResult();
    }

    // /**
    //  * @return Salles[] Returns an array of Salles objects
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
    public function findOneBySomeField($value): ?Salles
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

