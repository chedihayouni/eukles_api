<?php

declare(strict_types=1);

namespace App\Controller\Material;

use App\Controller\AbstractAction;
use App\Dto\Material\CreateMaterialDto;
use League\Fractal\Resource\Item;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CreateMaterial
 * @package App\Controller\Material
 */
class CreateMaterial extends AbstractAction
{
    const ROUTE_NAME = 'materials:create';

    /**
     *
     * @Route(
     *     name=CreateMaterial::ROUTE_NAME,
     *     path="/materials",
     *     methods={"POST"}
     * )
     *
     * @return JsonResponse
     */
    public function createMaterial(): JsonResponse
    {
        $errors = $this->validateContent(CreateMaterialDto::class);

        if(count($errors)){
            return new JsonResponse($errors, 422);
        }

        $material = $this->materialModel->createMaterial($this->getData());
        $this->entityManager->flush();

        $resource = new Item($material, $this->materialTransformer);
        $output   = $this->fractalManager->createData($resource)->toArray();

        return new JsonResponse($output, 201);
    }
}
