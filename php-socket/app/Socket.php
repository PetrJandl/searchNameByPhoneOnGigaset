<?php

namespace MyApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Socket implements MessageComponentInterface {

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {

        // Store the new connection in $this->clients
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
        foreach ( $this->clients as $client ) {
	    if($client->remoteAddress=="192.168.20.235" OR $client->remoteAddress=="192.168.133.80"){
    	        $client->send( "New connection! ({$conn->resourceId})" );
	    }
        }
    }

    public function onMessage(ConnectionInterface $from, $msg) {

        foreach ( $this->clients as $client ) {

/*
            if ( $from->resourceId == $client->resourceId ) {
                continue;
            }
*/
            //print_r($from);

//            $client->send( "Client $from->remoteAddress said $msg" );
            $client->send( "Client $from->resourceId said $msg;$from->remoteAddress;" );
        }
    }

    public function onClose(ConnectionInterface $conn) {
        foreach ( $this->clients as $client ) {
	    if($client->remoteAddress=="192.168.20.235" OR $client->remoteAddress=="192.168.133.80"){
    		$client->send( "Connection Close! ({$conn->resourceId})" );
	    }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
    }
}