<?php

namespace App\Repository;

use App\Entity\Etudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Etudiant>
 *
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }

//    /**
//     * @return Etudiant[] Returns an array of Etudiant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Etudiant
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

//Methode permettant de rechercher tous les étudiants mineurs
    public function findMineurs(): array
    {
        // Utiliser le langage DQL : Doctrine query language. Ce langage va permettre d'exprimer des requetes sur le modele objet
        // La requete DQL sera transformée en une requete SQL par Doctrine lors de l'exécution de la methode

        $dateMajorite=new \DateTime("-18 years");
        // 1. Exprimer la requête DQL
        $requeteDQL = "SELECT etudiant FROM App\Entity\Etudiant as etudiant WHERE etudiant.dateNaissance > :dateMajorite";
        // 2. Construire la requête. (représentation objet de la requête)
        $requete=$this->getEntityManager()->createQuery($requeteDQL);
        // 3. Donner une valeur au paramètre de la requête :dateMajorite
        $requete->setParameter("dateMajorite",$dateMajorite);
        // 4. Exécuter la requête et retourner le résultat
        //dd($requete->getSQL());
        return $requete->getResult();
    }
    public function findMineurs2():array{
        // Utiliser le Query Builder : class permettant de construire
        // Dynamiquement des requêtes DQL
        $dateMajorite = new \DateTime('-18 years');
        return $this->createQueryBuilder("e")
            ->where("e.dateNaissance > :dateMajorite")
            ->setParameter("dateMajorite",$dateMajorite)
            ->getQuery()
            ->getResult();
    }
}
