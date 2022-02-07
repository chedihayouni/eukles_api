<?php

declare(strict_types=1);

namespace App\Dto\Client;

use Symfony\Component\Validator\Constraints as Assert;


/**
 * /**
 * Class DeleteClientDto
 * @package FoodMeUp\Backend\Dto\Client
 */
class DeleteClientDto
{
    /**
     * @var string
     *
     * @Assert\NotNull(message="L'identifiant du client est requis")
     * @Assert\Uuid(message="L'identifiant du client est invalide")
     */
    public $id;
}