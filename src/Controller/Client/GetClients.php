<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Controller\AbstractAction;
use League\Fractal\Resource\Collection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GetClients
 * @package App\Controller\Client
 */
class GetClients extends AbstractAction
{
    const ROUTE_NAME = 'clients:get';

    /**
     *
     * @Route(
     *     name=GetClient::ROUTE_NAME,
     *     path="/clients",
     *     methods={"GET"}
     * )
     *
     * @return JsonResponse
     */
    public function getClientSales(): JsonResponse
    {
        $clients = $this->clientModel->getClients();
        $this->entityManager->flush();

        $resource = new Collection($clients, $this->clientTransformer);
        $output   = $this->fractalManager->createData($resource)->toArray();

        return new JsonResponse($output, 200);
    }
}
