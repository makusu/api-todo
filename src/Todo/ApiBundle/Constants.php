<?php

/**
 * This file is part of the Todo API.
 *
 * (c) Max Meiden Dasuki
 */

namespace Todo\ApiBundle;

class Constants
{
    const OK = 200;

    const EXCEPTION_VALIDATION_ERROR = 400;
    const EXCEPTION_VALIDATION_WRONG_VALUE = 403;

    const REDIS_KEY_TODO_COUNTER = 'todo_counter';
    const REDIS_KEY_TODO_ID_LIST = 'todo_id_list';
    const REDIS_KEY_TODO = 'todo_%s';
}
