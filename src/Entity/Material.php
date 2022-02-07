<?php

namespace App\Entity;

use App\Repository\MaterialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Material
 *
 * @ORM\Entity(repositoryClass="App\Repository\MaterialRepository")
 */
class Material
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

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
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $name;

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
     *
     * @ORM\Column(name="price", type="float", nullable=false)
     */
    private $price;

    /**
     * @var Collection<ClientMaterial>
     *
     * @ORM\OneToMany(targetEntity=ClientMaterial::class, mappedBy="material")
     */
    private $clientMaterials;

    /**
     * Client constructor.
     *
     * @param UuidInterface $id
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->clientMaterials = new ArrayCollection();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getClientMaterials(): Collection
    {
        return $this->clientMaterials;
    }

    /**
     * @param ClientMaterial $clientMaterial
     * @return Material
     */
    public function removeClientMaterial(ClientMaterial $clientMaterial): self
    {
        if (true === $this->clientMaterials->contains($clientMaterial)) {
            $this->clientMaterials->removeElement($clientMaterial);
        }
        return $this;
    }
}
