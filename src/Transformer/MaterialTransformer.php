<?php

declare(strict_types=1);

namespace App\Transformer;

use App\Entity\Material;
use League\Fractal\TransformerAbstract;

class MaterialTransformer extends TransformerAbstract
{
    public function transform(Material $material)
    {
        return [
            'id'    => $material->getId()->toString(),
            'name'  => $material->getName(),
            'price' => $material->getPrice()
        ];
    }
}
