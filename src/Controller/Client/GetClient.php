<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Controller\AbstractAction;
use App\Dto\Client\GetClientDto;
use League\Fractal\Resource\Item;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GetClient
 * @package App\Controller\Client
 */
class GetClient extends AbstractAction
{
    const ROUTE_NAME = 'client:get';

    /**
     *
     * @Route(
     *     name=GetClient::ROUTE_NAME,
     *     path="/clients/{id}",
     *     methods={"GET"}
     * )
     *
     * @return JsonResponse
     */
    public function getClient(string $id): JsonResponse
    {
        $errors = $this->validateContent(GetClientDto::class, ['id' => $id]);

        if(count($errors)){
            return new JsonResponse($errors, 422);
        }

        $client = $this->clientModel->getClient(Uuid::fromString($id));
        $this->entityManager->flush();

        $resource = new Item($client, $this->clientTransformer);
        $output   = $this->fractalManager->createData($resource)->toArray();

        return new JsonResponse($output, 200);
    }
}
