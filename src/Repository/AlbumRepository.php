<?php

namespace App\Repository;

use App\Entity\Album;
use App\Enum\AlbumType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Builder\Enum_;

/**
 * @extends ServiceEntityRepository<Album>
 */
class AlbumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Album::class);
    }

    public function findWithRelations(AlbumType $type, ?int $limit = null):array {
        
        // SELECT a.* FROM album AS a
        $qb =  $this->createQueryBuilder('a')
            // SELECT a.*, ar.*, t.* FROM album AS a
            ->addSelect('ar', 't')
            // JOIN artist AS ar ON ar.id = a.artist_id
            ->join('a.artist', 'ar')
             // JOIN track AS t ON t.album_id = a.id
            ->join('a.tracks', 't')
            // WHERE a.type = ? ("ep", "album", "single")
            ->where('a.type = :type ')
            ->setParameter('type', $type->value)
            // ORDER BY a.releaseDate DESC
            ->orderBy('a.releaseDate', 'DESC');

            if($limit !== null){
                // LIMIT $limit
                $qb->setMaxResults($limit)
                    -> groupBy('a');
            }
            // LIMIT 12
            return $qb->getQuery()
                ->getResult(); // $pdo->execute($statement)
    }
//    /**
//     * @return Album[] Returns an array of Album objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Album
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
