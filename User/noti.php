
<?php
use ElephantIO\Client as ElephantIOClient;
include("src/Client.php");
 
$elephant = new ElephantIOClient('127.0.0.1:3002', 'socket.io', 1, false, false, true);
$elephant->setHandshakeTimeout(1000);
$elephant->init();
$elephant->send(
ElephantIOClient::TYPE_EVENT, null, null, json_encode(array('name' => 'iotoserver', 'args' => array('channel' => 'my_first_channel', 'message' => 'my message to all the online users')))
    );
$elephant->close();
?>