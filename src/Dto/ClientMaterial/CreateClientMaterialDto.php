<?php

declare(strict_types=1);

namespace App\Dto\ClientMaterial;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CreateClientMaterialDto
 * @package App\Dto\ClientMaterial
 */
class CreateClientMaterialDto
{
    /**
     * @var string
     *
     * @Assert\NotNull(message="L'identifient du matériel est requis")
     * @Assert\Uuid(message="L'identifient du matériel est invalide")
     */
    public $material;

    /**
     * @var string
     *
     * @Assert\NotNull(message="L'identifient du client est requis")
     * @Assert\Uuid(message="L'identifient du client est invalide")
     */
    public $client;
}
