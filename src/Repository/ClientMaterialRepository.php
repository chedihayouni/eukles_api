<?php

namespace App\Repository;

use App\Entity\ClientMaterial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClientMaterial|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientMaterial|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientMaterial[]    findAll()
 * @method ClientMaterial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientMaterialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientMaterial::class);
    }

    public function getClientSales()
    {
        $result = $this->createQueryBuilder('cm')
            ->select('DISTINCT c.id as id, c.name as name, SUM(m.price) as price')
            ->leftJoin('cm.client', 'c')
            ->leftJoin('cm.material', 'm')
            // I change this question from 30 to 3 material so we can easily test it
            ->having('COUNT(c.id) >= 3')
            ->andHaving('SUM(m.price) >= 30000')
            ->groupBy('c.id')
            ->orderBy('price', 'DESC')
            ->getQuery()
            ->getResult();

        return $result;
    }
}
