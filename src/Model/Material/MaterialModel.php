<?php


namespace App\Model\Material;

use App\Dto\Material\CreateMaterialDto;
use App\Entity\Material;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MaterialModel
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return Material
     */
    public function createMaterial(CreateMaterialDto $materialDto): Material
    {
        $material = new Material();
        $material->setName($materialDto->name);
        $material->setPrice($materialDto->price);

        $this->entityManager->persist($material);

        return $material;
    }

    /**
     * @return Material[]
     */
    public function getMaterials(): array
    {
        return $this->entityManager->getRepository(Material::class)->findAll();
    }
}