<?php

declare(strict_types=1);

namespace App\Transformer;

use App\Entity\ClientMaterial;
use League\Fractal\TransformerAbstract;

class ClientMaterialTransformer extends TransformerAbstract
{
    public function transform(ClientMaterial $clientMaterial)
    {
        return [
            'id'                 => $clientMaterial->getId()->toString(),
            'client'             => $clientMaterial->getClient()->getId()->toString(),
            'material'           => $clientMaterial->getMaterial()->getId()->toString(),
        ];
    }
}
