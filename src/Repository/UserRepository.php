<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getAll_pagination($client, $page)
    {
        $qbd = $this->createQueryBuilder('user');
        
        $qbd->andWhere('user.client = :client')
        ->setParameter('client', $client)
        ->setFirstResult($page*5)
        ->setMaxResults(5);
        
        $data = $qbd->getQuery()->getResult();
        
        return $data;

    }

    /* public function getPaginateListOfUsers($page = 1, $nbElements = 10)
    {
        $firstResult = ($page - 1) * $nbElements;
        return $this->createQueryBuilder('User')
            ->setFirstResult($firstResult)
            ->setMaxResults($nbElements)
            ->getQuery()
            ->getResult()
        ;
    }*/

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
