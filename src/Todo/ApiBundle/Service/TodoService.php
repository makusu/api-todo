<?php

/**
 * This file is part of the Todo API.
 *
 * (c) Max Meiden Dasuki
 */

namespace Todo\ApiBundle\Service;

use Todo\ApiBundle\Model\TodoModel;

/**
 * Class TodoService
 * @package Todo\ApiBundle\Service
 */
class TodoService
{
    private $todo_model;

    public function setTodoModel($todo_model)
    {
        $this->todo_model = $todo_model;
    }

    /**
     * @return TodoModel
     */
    public function getTodoModel()
    {
        return $this->todo_model;
    }

    /**
     * Get all todo items
     *
     * @return array
     */
    public function getAll()
    {
        $todo_model = $this->getTodoModel();

        return $todo_model->getAll();
    }

    /**
     * Get todo
     *
     * @param int $id
     * @return array
     * @throws \Exception
     */
    public function get($id)
    {
        $todo_model = $this->getTodoModel();

        return $todo_model->getById($id);
    }

    /**
     * Add todo
     *
     * @param string $item
     * @return int
     */
    public function add($item)
    {
        $todo_model = $this->getTodoModel();
        $todo_model->item = $item;

        return $todo_model->save();
    }

    /**
     * Edit todo
     *
     * @param int $id
     * @param string $item
     * @return int
     */
    public function edit($id, $item)
    {
        $todo_model = $this->getTodoModel();
        $todo_model->getById($id);

        $this->todo_model->item = $item;

        return $todo_model->save();
    }

    /**
     * Delete todo
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $todo_model = $this->getTodoModel();
        $todo_model->id = $id;

        return $todo_model->delete();
    }
}
