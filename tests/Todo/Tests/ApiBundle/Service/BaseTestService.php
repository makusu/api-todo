<?php

/**
 * This file is part of the Todo API.
 *
 * (c) Max Meiden Dasuki
 */

namespace Todo\Tests\ApiBundle\Service;

use Symfony\Component\Validator\Validator\RecursiveValidator;
use Predis\Client;

class BaseTestService extends \PHPUnit_Framework_TestCase
{
    protected $app;

    public function __construct() {
        $this->app = require_once __DIR__ . '/../../../../../app/app.php';
    }

    /**
     * @return Client
     */
    public function getRedis()
    {
        return $this->app['predis'];
    }

    /**
     * @return RecursiveValidator
     */
    protected function getValidator()
    {
        return $this->app['validator'];
    }
}
