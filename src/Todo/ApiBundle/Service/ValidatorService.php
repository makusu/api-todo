<?php

/**
 * This file is part of the Todo API.
 *
 * (c) Max Meiden Dasuki
 */

namespace Todo\ApiBundle\Service;

use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\RecursiveValidator;
use Todo\ApiBundle\Constants;
use Todo\ApiBundle\Validation\ValidationInterface;

/**
 * Class ValidatorService
 * @package Todo\ApiBundle\Service
 */
class ValidatorService
{
    private $validator;

    /**
     * @param RecursiveValidator $validator
     */
    public function __construct(RecursiveValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Validate parameters from request
     *
     * @param array $params
     * @param string $validator_class
     * @return bool
     * @throws \Exception
     */
    public function validateRequest($params, $validator_class)
    {
        $validator_class = "Todo\\ApiBundle\\Validation\\" . $validator_class . "Validation";
        /** @var ValidationInterface $validation */
        $validation = new $validator_class();
        $constraints = $validation->getValidationConstraint();

        $errors = $this->getValidator()->validate($params, $constraints);

        if (count($errors) > 0) {
            $errorMessage = "";
            /** @var ConstraintViolation $error */
            foreach ($errors as $error) {
                $errorMessage .= $error->getPropertyPath().' '.$error->getMessage() . "\n";
            }
            throw new \Exception($errorMessage, Constants::EXCEPTION_VALIDATION_ERROR);
        }

        return true;
    }

    /**
     * @return RecursiveValidator
     */
    public function getValidator()
    {
        return $this->validator;
    }
}
