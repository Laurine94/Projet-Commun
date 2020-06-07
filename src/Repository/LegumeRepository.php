<?php

namespace App\Repository;

use App\Entity\Legume;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Legume|null find($id, $lockMode = null, $lockVersion = null)
 * @method Legume|null findOneBy(array $criteria, array $orderBy = null)
 * @method Legume[]    findAll()
 * @method Legume[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LegumeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Legume::class);
    }


     /**
     * @return mixed[]
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getBonneAsso($id){
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT legume2_id FROM association WHERE legume1_id='.$id.' and est_bon=1;';

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


     /**
     * @return mixed[]
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getMauvaiseAsso($id){
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT legume2_id FROM association WHERE legume1_id='.$id.' and est_bon=0;';

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


     /**
      * afficher les plantes en fonction de leur categorie
     * @return mixed[]
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getPlantesByCategorie($idcat){
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM legume WHERE categorie_id='.$idcat.';';

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    // /**
    //  * @return Legume[] Returns an array of Legume objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Legume
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
