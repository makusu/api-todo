<?php

/**
 * This file is part of the Todo API.
 *
 * (c) Max Meiden Dasuki
 */

namespace Todo\Tests\ApiBundle\Service;

use Exception;
use Todo\ApiBundle\Constants;
//use Todo\ApiBundle\Model\TodoModel;
use Todo\ApiBundle\Service\TodoService;

class TodoServiceTest extends BaseTestService
{
    public function testGetAll_outputTodoList()
    {
        $mock_get_all = [
            [
                'id'    => 1,
                'item'  => 'This is a new item'
            ],
            [
                'id'    => 2,
                'item'  => 'This is an edited item'
            ]
        ];

        $todo_model = $this->getMock('Todo\ApiBundle\Model\TodoModel', ['getAll'], array(), '', FALSE);
        $todo_model->expects($this->any())->method('getAll')->will($this->returnValue($mock_get_all));
        $todo_service = new TodoService();
        $todo_service->setTodoModel($todo_model);

        $expected = [
            [
                'id'    => 1,
                'item'  => 'This is a new item'
            ],
            [
                'id'    => 2,
                'item'  => 'This is an edited item'
            ]
        ];
        $actual = $todo_service->getAll();

        $this->assertEquals($expected, $actual);
    }

    public function testGet_inputId1_outputIdAndItem()
    {
        $input_id = 1;

        $mock_getById = [
            [
                'id'    => 1,
                'item'  => 'This is a new item'
            ]
        ];

        $todo_model = $this->getMock('Todo\ApiBundle\Model\TodoModel', ['getById'], array(), '', FALSE);
        $todo_model->expects($this->any())->method('getById')->will($this->returnValue($mock_getById));
        $todo_service = new TodoService();
        $todo_service->setTodoModel($todo_model);

        $expected = [
            [
                'id'    => 1,
                'item'  => 'This is a new item'
            ]
        ];
        $actual = $todo_service->get($input_id);

        $this->assertEquals($expected, $actual);
    }

    public function testAdd_inputItemThisIsANewItem_outputCounterId()
    {
        $input_item = 'This is a new item';

        $mock_save = 1;

        $todo_model = $this->getMock('Todo\ApiBundle\Model\TodoModel', ['save'], array(), '', FALSE);
        $todo_model->expects($this->any())->method('save')->will($this->returnValue($mock_save));
        $todo_service = new TodoService();
        $todo_service->setTodoModel($todo_model);

        $expected = 1;
        $actual = $todo_service->add($input_item);

        $this->assertEquals($expected, $actual);
    }

    public function testEdit_inputId1AndItemThisIsAnEditedItem_outputCounterId()
    {
        $input_id = 1;
        $input_item = 'This is an edited item';

        $mock_getById = [
            [
                'id'    => 1,
                'item'  => 'This is a new item'
            ]
        ];
        $mock_save = 1;

        $todo_model = $this->getMock('Todo\ApiBundle\Model\TodoModel', ['getById', 'save'], array(), '', FALSE);
        $todo_model->expects($this->any())->method('getById')->will($this->returnValue($mock_getById));
        $todo_model->expects($this->any())->method('save')->will($this->returnValue($mock_save));
        $todo_service = new TodoService();
        $todo_service->setTodoModel($todo_model);

        $expected = 1;
        $actual = $todo_service->edit($input_id, $input_item);

        $this->assertEquals($expected, $actual);
    }

    public function testDelete_inputId1_outputTrue()
    {
        $input_id = 1;

        $mock_delete = true;

        $todo_model = $this->getMock('Todo\ApiBundle\Model\TodoModel', ['delete'], array(), '', FALSE);
        $todo_model->expects($this->any())->method('delete')->will($this->returnValue($mock_delete));
        $todo_service = new TodoService();
        $todo_service->setTodoModel($todo_model);

        $expected = true;
        $actual = $todo_service->delete($input_id);

        $this->assertEquals($expected, $actual);
    }
}
