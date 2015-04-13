<?php

/**
 * This file is part of the Todo API.
 *
 * (c) Max Meiden Dasuki
 */

namespace Todo\ApiBundle\Validation;

interface ValidationInterface
{
    public function getValidationConstraint();
}
