<?php

use InfoGame\GerenciadorDeConexoes;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require dirname( __FILE__ ) . '/vendor/autoload.php';

IoServer::factory(
    new HttpServer(
        new WsServer(
            new GerenciadorDeConexoes()
        )
    ),
    8080
)->run();