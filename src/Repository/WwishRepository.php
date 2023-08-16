<?php

namespace App\Repository;

use App\Entity\Wwish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Wwish>
 *
 * @method Wwish|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wwish|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wwish[]    findAll()
 * @method Wwish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WwishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wwish::class);
    }


    public function findAllPublished() :Paginator
    {
        $query =  $this->createQueryBuilder('w')
            ->leftJoin('w.category', 'c')
            ->addSelect('c')
            ->andWhere('w.isPublished = true')
            ->addOrderBy('w.dateCreated', 'DESC')
            ->setMaxResults(10)
           ->getQuery();

        $paginator = new Paginator($query);
        return $paginator;

}





//    /**
//     * @return Wwish[] Returns an array of Wwish objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Wwish
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
