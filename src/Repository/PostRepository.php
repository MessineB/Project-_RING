<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function add(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Post[] Returns an array of Post objects
    */
   public function findByStatus($value): array
   {
       return $this->createQueryBuilder('p')
           ->andWhere('p.currentState = :val')
           ->setParameter('val', $value)
           ->orderBy('p.created', 'DESC')
           ->setMaxResults(100)
           ->getQuery()
           ->getResult()
       ;
   }


   
   /**
    * @return Post[] Returns an object of Post objects
    */
    public function findById($value): object
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
    * @return Post[] Returns an array of posts by user
    */
    public function findByUser($value): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.user = :val')
            ->andWhere("p.currentState = 'published'")
            ->setParameter('val', $value)
            ->orderBy('p.created', 'DESC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
        ;
    }


   

//    public function findOneBySomeField($value): ?Post
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}