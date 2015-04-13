<?php

/**
 * This file is part of the Todo API.
 *
 * (c) Max Meiden Dasuki
 */

namespace Todo\ApiBundle\Controller;

use Silex\Application;
use Symfony\Component\Validator\Validator\RecursiveValidator;
use Predis\Client;

/**
 * Class BaseController
 * @package Todo\ApiBundle\Controller
 */
class BaseController
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @return Client
     */
    protected function getRedis()
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
