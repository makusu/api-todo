<?php

/**
 * This file is part of the Todo API.
 *
 * (c) Max Meiden Dasuki
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Todo\ApiBundle\Controller;

/** @var $app Silex\Application */
$app["controller.todo"] = $app->share(function () use ($app) {
    return new Controller\TodoController($app);
});

$app->error(function (Exception $e, $code) {
    $data = [
        "code"=>(int)$e->getCode(),
        "message"=>$e->getMessage()
    ];
    return new Response(json_encode($data), $code, ["Content-Type" => "application/json", 'X-Status-Code' => Todo\ApiBundle\Constants::OK]);
});

$app->after(function (Request $request, Response $response) {
    $obj = json_decode($response->getContent(), true);
    if(!$obj || !isset($obj['code'])) {
        $newObj = [
            "code"      => Todo\ApiBundle\Constants::OK,
            "message"   => "OK",
            "payload"   => $obj
        ];

        $response->setContent(json_encode($newObj));
    }
});


// ===== TODO =====

$app->get("/todo", "controller.todo:getAllAction");

$app->get("/todo/{id}", "controller.todo:getAction")->assert('id', '\d+');

$app->post("/todo", "controller.todo:addAction");

$app->put("/todo/{id}", "controller.todo:editAction")->assert('id', '\d+');

$app->delete("/todo/{id}", "controller.todo:deleteAction")->assert('id', '\d+');

$app->get('/', function () use ($app) {
    return $app->json(
        [
            "Todo API using Silex. For PUT and DELETE, we need to input (string) `item` as a field.",
            "Available APIs are:",
            "GET: /todo",
            "GET: /todo/{id}",
            "POST: /todo",
            "PUT: /todo/{id}",
            "DELETE: /todo/{id}",
        ]
    );
});
