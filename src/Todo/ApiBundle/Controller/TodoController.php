<?php

/**
 * This file is part of the Todo API.
 *
 * (c) Max Meiden Dasuki
 */

namespace Todo\ApiBundle\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Todo\ApiBundle\Model\TodoModel;
use Todo\ApiBundle\Service\TodoService;
use Todo\ApiBundle\Service\ValidatorService;

/**
 * Class TodoController
 * @package Todo\ApiBundle\Controller
 */
class TodoController extends BaseController
{
    /**
     * Get all todo items
     *
     * @return JsonResponse
     */
    public function getAllAction()
    {
        $todo_model = new TodoModel();
        $todo_model->setRedis($this->getRedis());
        $todo_service = new TodoService();
        $todo_service->setTodoModel($todo_model);

        $todo_list = $todo_service->getAll();

        return $this->app->json($todo_list);
    }

    /**
     * Get todo item by ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getAction($id)
    {
        $todo_model = new TodoModel();
        $todo_model->setRedis($this->getRedis());
        $todo_service = new TodoService();
        $todo_service->setTodoModel($todo_model);

        $todo = $todo_service->get($id);

        return $this->app->json($todo);
    }

    /**
     * Add new todo item
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addAction(Request $request)
    {
        $params = $request->request->all();

        $validator_service = new ValidatorService($this->getValidator());
        $validator_service->validateRequest($params, "Todo");

        $todo_model = new TodoModel();
        $todo_model->setRedis($this->getRedis());
        $todo_service = new TodoService();
        $todo_service->setTodoModel($todo_model);

        $id = $todo_service->add($params['item']);

        return $this->app->json(['id' => $id]);
    }

    /**
     * Edit todo item by ID
     *
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function editAction($id, Request $request)
    {
        $params = $request->request->all();

        $validator_service = new ValidatorService($this->getValidator());
        $validator_service->validateRequest($params, "Todo");

        $todo_model = new TodoModel();
        $todo_model->setRedis($this->getRedis());
        $todo_service = new TodoService();
        $todo_service->setTodoModel($todo_model);

        $result = $todo_service->edit($id, $params['item']);

        return $this->app->json($result);
    }

    /**
     * Delete todo item by ID
     *
     * @param $id
     * @return JsonResponse
     */
    public function deleteAction($id)
    {
        $todo_model = new TodoModel();
        $todo_model->setRedis($this->getRedis());
        $todo_service = new TodoService();
        $todo_service->setTodoModel($todo_model);

        $result = $todo_service->delete($id);

        return $this->app->json($result);
    }
}
