<?php

declare(strict_types=1);

namespace App\Dto\Material;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CreateMaterialDto
 * @package App\Dto\Material
 */
class CreateMaterialDto
{
    /**
     * @var string
     *
     * @Assert\NotNull(message="Le nom du matériel est requis.")
     * @Assert\Length(
     *      min="1",
     *      max="100",
     *      minMessage = "Le nom du matériel contient au moins 1 caractère",
     *      maxMessage = "Le nom du matériel contient au maximum 100 caractère"
     * )
     */
    public $name;

    /**
     * @var float
     *
     * @Assert\NotNull(message="Prix du matériel est requis")
     * @Assert\GreaterThan(
     *     value="0",
     *     message="Prix du matériel doit etre supérieure à 0"
     * )
     * @Assert\Type(
     *     type="numeric",
     *     message="Prix du matériel doit etre de type numérique"
     * )
     */
    public $price;
}
