<?php

namespace App\Entity;

use App\Repository\ClientMaterialRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ClientMaterial
 *
 * @ORM\Entity(repositoryClass="App\Repository\ClientMaterialRepository")
 */
class ClientMaterial
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
     * @var Client
     *
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="clientMaterials")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @var Material
     *
     * @ORM\ManyToOne(targetEntity=Material::class, inversedBy="clientMaterials")
     * @ORM\JoinColumn(nullable=false)
     */
    private $material;

    /**
     * Client constructor.
     *
     * @param UuidInterface $id
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     * @return $this
     */
    public function setClient(Client $client): self
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return Material
     */
    public function getMaterial(): Material
    {
        return $this->material;
    }

    /**
     * @param Material $material
     * @return $this
     */
    public function setMaterial(Material $material): self
    {
        $this->material = $material;
        return $this;
    }
}
