<?php

namespace App\Repository;

use App\Entity\Ad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ad[]    findAll()
 * @method Ad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ad::class);
    }

    public function findAllProducers() : array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT car_producer FROM ad GROUP BY car_producer';

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();

        foreach ($results as $result) {
            $producers[] = $result['car_producer'];
        }

        return $producers;
    }

    public function findAllCountries() : array 
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT car.producer_country FROM car INNER JOIN ad ON ad.car_id=car.id GROUP BY car.producer_country';

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();

        foreach ($results as $result) {
            $countries[] = $result['producer_country'];
        }

        return $countries;
    }

    public function findYearRange() : array 
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT MIN(car_year) FROM ad';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        $min_year = $result['MIN(car_year)'];

        $sql = 'SELECT MAX(car_year) FROM ad';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        $max_year = $result['MAX(car_year)'];

        $year = $min_year;
        while ($year<=$max_year) {
            $years[] = $year;
            $year++;
        }

        return $years;
    }

    // /**
    //  * @return Ad[] Returns an array of Ad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ad
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
