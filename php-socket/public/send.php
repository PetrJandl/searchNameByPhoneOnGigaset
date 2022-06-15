<?php 


require_once('../vendor/autoload.php');

$socket = new \HemiFrame\Lib\WebSocket\WebSocket('192.168.133.222', 8080);
$socket->on("receive", function($client, $data) use($socket) {
});
$client = $socket->connect();
if ($client) {
    $socket->sendData($client, '{"src":"1.1.1.1","dst":"9.8.3.2","name":"No Ka","phone":"123"}');
    $socket->disconnectClient($client);
}
