<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ValidationService
 * @package App\Service
 */
class ValidationService extends \Exception
{
    /**
     * @var array
     */
    private $errors = [];

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(
        ValidatorInterface $validator
    ) {
        $this->validator = $validator;

        parent::__construct();
    }

    /**
     * @param object $object
     * @param null $constraints
     * @param string|string[]|null $groups
     * @return object
     * @throws \Exception
     */
    public function validateObject($object, $constraints = null, $groups = null)
    {
        $violations = $this->validator->validate($object, $constraints, $groups);

        if (count($violations)) {
            /** @var ConstraintViolationInterface $violation */
            foreach ($violations as $violation) {
                $this->errors[] = [
                    'message'      => $violation->getMessage()
                ];
            }
        }

        return $object;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
