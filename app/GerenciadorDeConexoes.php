<?php

namespace InfoGame;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class GerenciadorDeConexoes implements MessageComponentInterface
{
    private $conexoes;

    public function __construct()
    {
        $this->conexoes = [];
        echo 'Servidor iniciado!' . "\n";
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->conexoes[] = $conn;

        echo 'Conexão estabelecida! Número do cliente: ' . $conn->resourceId . "\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        foreach ($this->conexoes as $conexao) {
            if ($conexao->resourceId != $from->resourceId) {
                $conexao->send(
                    "Mensagem do cliente $from->resourceId:  $msg"
                );
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        echo 'Conexão fechada! Número do cliente: ' . $conn->resourceId . "\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo 'ERRO! Número do cliente: ' . $conn->resourceId . "\n";
    }
}
