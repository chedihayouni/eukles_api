<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Class Client
 *
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
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
     * @Assert\NotNull(message="Le nom du client est requis.")
     * @Assert\Length(
     *      min="1",
     *      max="100",
     *      minMessage = "Le nom du client contient au moins 1 caractère",
     *      maxMessage = "Le nom du client contient au maximum 100 caractère"
     * )
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var Collection<ClientMaterial>
     *
     * @ORM\OneToMany(targetEntity=ClientMaterial::class, mappedBy="client")
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

    /**
     * @return Collection
     */
    public function getClientMaterials(): Collection
    {
        return $this->clientMaterials;
    }

    /**
     * @param ClientMaterial $clientMaterial
     * @return Client
     */
    public function removeClientMaterial(ClientMaterial $clientMaterial): self
    {
        if (true === $this->clientMaterials->contains($clientMaterial)) {
            $this->clientMaterials->removeElement($clientMaterial);
        }
        return $this;
    }
}
