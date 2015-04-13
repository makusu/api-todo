<?php

/**
 * This file is part of the Todo API.
 *
 * (c) Max Meiden Dasuki
 */

require_once __DIR__.'/../vendor/autoload.php';

$loader = new Symfony\Component\ClassLoader\ClassLoader();

$loader->addPrefix('Todo', __DIR__.'/../src');

$loader->register();

return $loader;
