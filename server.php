<?php
var_dump(getenv('MY_ENV'));
// $port    = 8888;
// $clients = [];
// $socket  = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
// socket_bind($socket, '127.0.0.1', $port);
// socket_listen($socket);
// socket_set_nonblock($socket);

// while (true) {
//     if (($newc = socket_accept($socket)) !== false) {
//         echo "Client $newc has connected " . get_resource_type($newc) . "\n";
//         $clients[] = $newc;
//     }
// }
