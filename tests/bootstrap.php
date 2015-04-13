<?php

/**
 * This file is part of the Todo API.
 *
 * (c) Max Meiden Dasuki
 */

$loader = require_once __DIR__ . '/../app/bootstrap.php';

$loader->addPrefix('Todo\Tests', __DIR__);

$loader->register();
