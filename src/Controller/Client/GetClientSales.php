<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Controller\AbstractAction;
use League\Fractal\Resource\Collection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GetClientSales
 * @package App\Controller\Client
 */
class GetClientSales extends AbstractAction
{
    const ROUTE_NAME = 'client-sales:get';

    /**
     *
     * @Route(
     *     name=GetClientSales::ROUTE_NAME,
     *     path="/client-sales",
     *     methods={"GET"}
     * )
     *
     * @return JsonResponse
     */
    public function getClientSales(): JsonResponse
    {
        $clients = $this->clientModel->getClientSales();
        $this->entityManager->flush();

        $resource = new Collection($clients, $this->salesTransformer);
        $output   = $this->fractalManager->createData($resource)->toArray();

        return new JsonResponse($output, 200);
    }
}
