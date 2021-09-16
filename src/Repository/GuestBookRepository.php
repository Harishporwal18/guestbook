<?php

namespace App\Repository;

use App\Entity\GuestBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GuestBook|null find($id, $lockMode = null, $lockVersion = null)
 * @method GuestBook|null findOneBy(array $criteria, array $orderBy = null)
 * @method GuestBook[]    findAll()
 * @method GuestBook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GuestBookRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GuestBook::class);
    }

    /**
     * Find all the Guest under given user
     * @param $value
     * @return GuestBook()
     */
    public function findGuestBookByUser($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.user = :val')
            ->setParameter('val', $value)
            ->getQuery();
    }


}
