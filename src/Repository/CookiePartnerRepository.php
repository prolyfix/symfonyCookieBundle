<?php

namespace Prolyfix\SymfonyCookieNotificationBundle\Repository;

use Prolyfix\SymfonyCookieNotificationBundle\Entity\CookiePartner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CookiePartner>
 *
 * @method CookiePartner|null find($id, $lockMode = null, $lockVersion = null)
 * @method CookiePartner|null findOneBy(array $criteria, array $orderBy = null)
 * @method CookiePartner[]    findAll()
 * @method CookiePartner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CookiePartnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CookiePartner::class);
    }

    public function save(CookiePartner $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CookiePartner $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CookiePartner[] Returns an array of CookiePartner objects
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

//    public function findOneBySomeField($value): ?CookiePartner
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
