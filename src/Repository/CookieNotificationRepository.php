<?php

namespace Prolyfix\SymfonyCookieNotificationBundle\Repository;

use Prolyfix\SymfonyCookieNotificationBundle\Entity\CookieNotification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CookieNotification>
 *
 * @method CookieNotification|null find($id, $lockMode = null, $lockVersion = null)
 * @method CookieNotification|null findOneBy(array $criteria, array $orderBy = null)
 * @method CookieNotification[]    findAll()
 * @method CookieNotification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CookieNotificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CookieNotification::class);
    }

    public function save(CookieNotification $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CookieNotification $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CookieNotification[] Returns an array of CookieNotification objects
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

//    public function findOneBySomeField($value): ?CookieNotification
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
