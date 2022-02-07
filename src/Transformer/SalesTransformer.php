<?php

declare(strict_types=1);

namespace App\Transformer;

use League\Fractal\TransformerAbstract;

class SalesTransformer extends TransformerAbstract
{
    public function transform(array $data)
    {
        return [
            'id'    => $data['id']->toString(),
            'name'  => $data['name'],
            'sales' => $data['price'],
        ];
    }
}
