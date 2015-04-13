<?php

/**
 * This file is part of the Todo API.
 *
 * (c) Max Meiden Dasuki
 */

namespace Todo\ApiBundle\Model;

use Silex\Application;
use Predis\Client;
use Todo\ApiBundle\Constants;

/**
 * Class TodoModel
 * @package Todo\ApiBundle\Model
 */
class TodoModel
{
    public $redis;

    public $id;
    public $item;

    public function setRedis($redis)
    {
        $this->redis = $redis;
    }

    /**
     * @return Client
     */
    public function getRedis()
    {
        return $this->redis;
    }

    /**
     * Get todo counter
     *
     * @return int
     */
    public function getCounter()
    {
        return $this->getRedis()->incr(Constants::REDIS_KEY_TODO_COUNTER);
    }

    /**
     * Save todo
     *
     * @return int
     */
    public function save()
    {
        if (empty($this->id)) {
            $this->id = $this->getCounter();
            $this->getRedis()->sadd(Constants::REDIS_KEY_TODO_ID_LIST, [$this->id]);
        }

        $this->getRedis()->set(sprintf(Constants::REDIS_KEY_TODO, $this->id), $this->item);

        return $this->id;
    }

    /**
     * Delete todo
     *
     * @return bool
     */
    public function delete()
    {
        $this->getById($this->id);

        $this->getRedis()->srem(Constants::REDIS_KEY_TODO_ID_LIST, $this->id);
        $this->getRedis()->del(sprintf(Constants::REDIS_KEY_TODO, $this->id));

        return true;
    }

    /**
     * Get todo by ID
     *
     * @param int $id
     * @return array
     * @throws \Exception
     */
    public function getById($id)
    {
        $item = $this->getRedis()->get(sprintf(Constants::REDIS_KEY_TODO, $id));

        if (empty($item)) {
            throw new \Exception("Todo not found", Constants::EXCEPTION_VALIDATION_WRONG_VALUE);
        }

        $this->id = $id;
        $this->item = $item;

        return [
            'id'    => $this->id,
            'item'  => $this->item
        ];
    }

    /**
     * Get all todo items
     *
     * @return array
     * @throws \Exception
     */
    public function getAll()
    {
        $id_list = $this->getRedis()->smembers(Constants::REDIS_KEY_TODO_ID_LIST);

        $todo_list = [];
        foreach ($id_list as $id) {
            $todo_list[] = $this->getById($id);
        }

        return $todo_list;
    }
}
