<?php

declare(strict_types=1);

namespace App\Dto\Client;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CreateClientDto
 * @package App\Dto\Client
 */
class CreateClientDto
{
    /**
     * @var string
     * @Assert\NotNull(message="Le nom de client est requis")
     * @Assert\Length(
     *    min="1",
     *    max="100",
     *    minMessage = "Le nom de client contient au moins 1 caractère",
     *    maxMessage = "Le nom de client contient au maximum 100 caractères"
     * )
     */
    public $name;
}
