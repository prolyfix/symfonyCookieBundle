<?php

namespace Prolyfix\SymfonyCookieNotificationBundle\Repository;

use Prolyfix\SymfonyCookieNotificationBundle\Entity\CookieScript;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CookieScript>
 *
 * @method CookieScript|null find($id, $lockMode = null, $lockVersion = null)
 * @method CookieScript|null findOneBy(array $criteria, array $orderBy = null)
 * @method CookieScript[]    findAll()
 * @method CookieScript[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CookieScriptRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CookieScript::class);
    }

    public function save(CookieScript $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CookieScript $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CookieScript[] Returns an array of CookieScript objects
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

//    public function findOneBySomeField($value): ?CookieScript
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
