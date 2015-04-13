<?php

/**
 * This file is part of the Todo API.
 *
 * (c) Max Meiden Dasuki
 */

namespace Todo\ApiBundle\Validation;

use Symfony\Component\Validator\Constraints;

class TodoValidation implements ValidationInterface
{
    public function getValidationConstraint()
    {
        $constraints = new Constraints\Collection(["fields" => [
            'item'  => new Constraints\NotBlank()
        ]]);

        return $constraints;
    }
}
