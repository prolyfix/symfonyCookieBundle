<?php

namespace Prolyfix\SymfonyCookieNotificationBundle\Repository;

use Prolyfix\SymfonyCookieNotificationBundle\Entity\CookieCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CookieCategory>
 *
 * @method CookieCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CookieCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CookieCategory[]    findAll()
 * @method CookieCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CookieCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CookieCategory::class);
    }

    public function save(CookieCategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CookieCategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CookieCategory[] Returns an array of CookieCategory objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CookieCategory
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
