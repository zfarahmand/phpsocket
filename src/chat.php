<?php
namespace ChatApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;

    // Constructor
    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    // Stablish a connection to send messages
    public function onOpen(ConnectionInterface $connection) {
        $this->clients->attach($connection);
        echo "New connection! ({$connection->resourceId})\n";
    }

    // Send messages to all clients except current client
    public function onMessage(ConnectionInterface $from , $message) {
        echo "message";
        foreach($clients as $client) {
            if($client !== $from) {
                $client->send($message);
            }
        }
    }

    // Close the connection so the client can't send or recieve messages from the server anymore
    public function onClose(ConnectionInterface $connection) {
        $this->clients->detach($connection);
        echo "Connection {$connection->resourceId} has been ended!\n";
    }

    // Close the connection if there's an error after showing the error message
    public function onError(ConnectionInterface $connection , \Exception $e) {
        echo "An error has been occurred: {$e->getMessage()}\n";
        $connection->close();
    }
}
