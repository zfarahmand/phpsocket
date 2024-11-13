<?php
require __DIR__ . '/vendor/autoload.php';

//require('vendor/autoload.php');

use Ratchet\Server\IoServer;
use ChatApp\Chat;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

$server = IoServer::factory( 
    new HttpServer(new WsServer(new Chat())) , 8080);


$server->run();

// $app = new Ratchet\App('localhost', 8080);
// $app->route('/chat', new Chat, array('*'));
// $app->route('/echo', new Ratchet\Server\EchoServer, array('*'));
// var_dump($app);
// $app->run();