<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Controller\AbstractAction;
use App\Dto\Client\CreateClientDto;
use League\Fractal\Resource\Item;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CreateClient
 * @package App\Controller\Client
 */
class CreateClient extends AbstractAction
{
    const ROUTE_NAME = 'clients:create';

    /**
     *
     * @Route(
     *     name=CreateClient::ROUTE_NAME,
     *     path="/clients",
     *     methods={"POST"}
     * )
     *
     * @return JsonResponse
     */
    public function createClient(): JsonResponse
    {
        $errors = $this->validateContent(CreateClientDto::class);

        if(count($errors)){
            return new JsonResponse($errors, 422);
        }

        $client = $this->clientModel->createClient($this->getData());
        $this->entityManager->flush();

        $resource = new Item($client, $this->clientTransformer);
        $output   = $this->fractalManager->createData($resource)->toArray();

        return new JsonResponse($output, 201);
    }
}
