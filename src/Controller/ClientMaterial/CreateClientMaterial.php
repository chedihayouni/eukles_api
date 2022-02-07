<?php

declare(strict_types=1);

namespace App\Controller\ClientMaterial;

use App\Controller\AbstractAction;
use App\Dto\ClientMaterial\CreateClientMaterialDto;
use League\Fractal\Resource\Item;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CreateClientMaterial
 * @package App\Controller\ClientMaterial
 */
class CreateClientMaterial extends AbstractAction
{
    const ROUTE_NAME = 'client-materials:create';

    /**
     *
     * @Route(
     *     name=CreateClientMaterial::ROUTE_NAME,
     *     path="/client-materials",
     *     methods={"POST"}
     * )
     *
     * @return JsonResponse
     */
    public function createClientMaterial(): JsonResponse
    {
        $errors = $this->validateContent(CreateClientMaterialDto::class);

        if(count($errors)){
            return new JsonResponse($errors, 422);
        }

        $clientMaterial = $this->clientMaterialModel->createClientMaterial($this->getData());
        $this->entityManager->flush();

        $resource = new Item($clientMaterial, $this->clientMaterialTransformer);
        $output   = $this->fractalManager->createData($resource)->toArray();

        return new JsonResponse($output, 201);
    }
}
