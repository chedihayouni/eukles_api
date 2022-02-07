<?php

namespace App\Model\Client;

use App\Dto\Client\CreateClientDto;
use App\Entity\Client;
use App\Entity\ClientMaterial;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ClientModel
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
     * @return Client
     */
    public function createClient(CreateClientDto $clientDto): Client
    {
        $client = new Client();
        //We can replace this statement by adding an auto-mapping between the dto and the entity
        $client->setName($clientDto->name);

        $this->entityManager->persist($client);

        return $client;
    }

    /**
     * @return Client[]
     */
    public function getClientSales(): array
    {
        return $this->entityManager->getRepository(ClientMaterial::class)->getClientSales();
    }

    /**
     * @return Client[]
     */
    public function getClients(): array
    {
        return $this->entityManager->getRepository(Client::class)->findAll();
    }

    /**
     * @param UuidInterface $clientId
     * @return Client
     */
    public function getClient(UuidInterface $clientId): Client
    {
        /** @var Client|null $client */
        $client = $this->entityManager->getRepository(Client::class)->find($clientId);

        if (null === $client) {
            throw new HttpException(404, 'Le client est introuvable');
        }

        return $client;
    }

    /**
     * @param Client $client
     */
    public function deleteClient(Client $client): void
    {
        $this->entityManager->remove($client);
    }
}