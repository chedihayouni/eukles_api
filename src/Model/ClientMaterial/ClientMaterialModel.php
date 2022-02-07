<?php


namespace App\Model\ClientMaterial;

use App\Dto\ClientMaterial\CreateClientMaterialDto;
use App\Entity\ClientMaterial;
use App\Entity\Material;
use App\Model\Client\ClientModel;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ClientMaterialModel
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ClientModel
     */
    private $clientModel;

    /**
     * ClientMaterialModel constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param ClientModel $clientModel
     */
    public function __construct(EntityManagerInterface $entityManager, ClientModel $clientModel)
    {
        $this->entityManager = $entityManager;
        $this->clientModel   = $clientModel;
    }

    /**
     * @return ClientMaterial
     */
    public function createClientMaterial(CreateClientMaterialDto $clientMaterialDto): ClientMaterial
    {
        $client = $this->clientModel->getClient(Uuid::fromString($clientMaterialDto->client));

        /** @var MAterial|null $material */
        $material = $this->entityManager->getRepository(Material::class)->find($clientMaterialDto->material);

        if (null === $material) {
            throw new HttpException(404, 'Le matériel est introuvable');
        }

        $clientMaterial = new ClientMaterial();
        $clientMaterial->setClient($client);
        $clientMaterial->setMaterial($material);

        $this->entityManager->persist($clientMaterial);

        return $clientMaterial;
    }
}