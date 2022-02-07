<?php

declare(strict_types=1);

namespace App\Controller\Material;

use App\Controller\AbstractAction;
use League\Fractal\Resource\Collection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GetMaterials
 * @package App\Controller\Material
 */
class GetMaterials extends AbstractAction
{
    const ROUTE_NAME = 'materials:get';

    /**
     *
     * @Route(
     *     name=GetMaterials::ROUTE_NAME,
     *     path="/materials",
     *     methods={"GET"}
     * )
     *
     * @return JsonResponse
     */
    public function getMaterials(): JsonResponse
    {
        $materials = $this->materialModel->getMaterials();
        $this->entityManager->flush();

        $resource = new Collection($materials, $this->materialTransformer);
        $output   = $this->fractalManager->createData($resource)->toArray();

        return new JsonResponse($output, 200);
    }
}
