<?php

namespace App\Controller;


use App\Entity\Client;
use App\Model\Client\ClientModel;
use App\Model\ClientMaterial\ClientMaterialModel;
use App\Model\Material\MaterialModel;
use App\Service\ValidationService;
use App\Transformer\ClientMaterialTransformer;
use App\Transformer\ClientTransformer;
use App\Transformer\MaterialTransformer;
use App\Transformer\SalesTransformer;
use Doctrine\ORM\EntityManagerInterface;
use League\Fractal\Manager;
use League\Fractal\Serializer\ArraySerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Serializer;


/**
 * Class AbstractAction
 * @package App\Controller
 */
abstract class AbstractAction extends AbstractController
{

    private $data = null;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var Manager
     */
    protected $fractalManager;

    /**
     * @var RequestStack
     */
    public $request;

    /**
     * @var DenormalizerInterface
     */
    protected $denormalizer;

    /**
     * @var ClientTransformer
     */
    protected $clientTransformer;

    /**
     * @var ClientModel
     */
    protected $clientModel;

    /**
     * @var ValidationService
     */
    protected $validator;

    /**
     * @var MaterialTransformer
     */
    protected $materialTransformer;

    /**
     * @var MaterialModel
     */
    protected $materialModel;

    /**
     * @var ClientMaterialTransformer
     */
    protected $clientMaterialTransformer;

    /**
     * @var ClientMaterialModel
     */
    protected $clientMaterialModel;

    /**
     * @var SalesTransformer
     */
    protected $salesTransformer;

    /**
     * AbstractAction constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param DenormalizerInterface $denormalizer
     * @param RequestStack $request
     * @param ClientTransformer $clientTransformer
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        DenormalizerInterface $denormalizer,
        RequestStack $request,
        ClientTransformer $clientTransformer,
        ClientModel $clientModel,
        ValidationService $validator,
        MaterialTransformer $materialTransformer,
        MaterialModel $materialModel,
        ClientMaterialTransformer $clientMaterialTransformer,
        ClientMaterialModel $clientMaterialModel,
        SalesTransformer $salesTransformer
    ) {
        $this->request = $request->getCurrentRequest();
        $this->entityManager = $entityManager;
        $this->denormalizer = $denormalizer;
        $this->clientTransformer = $clientTransformer;
        $this->clientModel = $clientModel;
        $this->validator = $validator;
        $this->materialTransformer = $materialTransformer;
        $this->materialModel = $materialModel;
        $this->clientMaterialTransformer = $clientMaterialTransformer;
        $this->clientMaterialModel = $clientMaterialModel;
        $this->salesTransformer = $salesTransformer;

        $this->fractalManager = new Manager();
        $this->fractalManager->setSerializer(new ArraySerializer());
    }

    /**
     * @param $dto
     * @return array
     */
    public function validateContent($dto, $extraContent = null): array
    {
        $content = json_decode($this->request->getContent(), true) ?? [];

        if (null !== $extraContent) {
            $content = array_merge($content, $extraContent);
        }

        $object = $this->denormalizer->denormalize(
            $content,
            $dto,
            'json'
        );

        $this->validator->validateObject($object);

        $this->setData($object);

        return $this->validator->getErrors();
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}
