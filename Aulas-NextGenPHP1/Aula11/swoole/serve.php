<?php


require __DIR__ . '/vendor/autoload.php';

use Swoole\Constant;
use Swoole\Http\Server;

// montar um servidor usando o próprio PHP
$server = new Server("0.0.0.0", 80);

$server->set([
    'worker_num' => 24,
]);

$server->on(Constant::EVENT_START, function () {
    echo "Swoole http server is started at http://0.0.0.0:80" . PHP_EOL;
});

$server->on(Constant::EVENT_REQUEST, function ($request, $response) {
    $response->header('Content-Type', 'application/json');
    $response->end(json_encode([ 'hello' => 'world' ]));
});

$server->start();
