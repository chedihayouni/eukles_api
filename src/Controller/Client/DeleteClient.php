<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Controller\AbstractAction;
use App\Dto\Client\DeleteClientDto;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteClient
 * @package DeleteClient\Controller\Client
 */
class DeleteClient extends AbstractAction
{
    const ROUTE_NAME = 'client:delete';

    /**
     *
     * @Route(
     *     name=DeleteClient::ROUTE_NAME,
     *     path="/clients/{id}",
     *     methods={"DELETE"}
     * )
     *
     * @return JsonResponse
     */
    public function getClient(string $id): JsonResponse
    {
        $errors = $this->validateContent(DeleteClientDto::class, ['id' => $id]);

        if(count($errors)){
            return new JsonResponse($errors, 422);
        }

        $client = $this->clientModel->getClient(Uuid::fromString($id));
        $this->clientModel->deleteClient($client);

        $this->entityManager->flush();

        return new JsonResponse(null, 204);
    }
}
