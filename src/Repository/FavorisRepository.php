<?php

namespace App\Repository;

use App\Entity\Favoris;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Favoris|null find($id, $lockMode = null, $lockVersion = null)
 * @method Favoris|null findOneBy(array $criteria, array $orderBy = null)
 * @method Favoris[]    findAll()
 * @method Favoris[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavorisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Favoris::class);
    }

      /**
      * permet d'afficher un legume un favoris pour un utilisateur
     * @return mixed[]
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getfav($idLegume, $idDressseur){
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM favoris WHERE favoris.id_legume_id='.$idLegume.' AND favoris.id_utilisateur_id='.$idDressseur.';';

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
      * permet d'afficher un legume un favoris pour un utilisateur
     * @return mixed[]
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getAllFav($idDressseur){
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT id_legume_id FROM favoris WHERE favoris.id_utilisateur_id='.$idDressseur.';';

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // /**
    //  * @return Favoris[] Returns an array of Favoris objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Favoris
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
