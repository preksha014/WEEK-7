<?php

$router->get('/','index.php');

$router->get('/groups','groups/show.php');

$router->get('/groups/create','groups/create.php');
$router->post('/groups','groups/store.php');

$router->post('/groups/edit','groups/edit.php');
$router->patch('/groups','groups/update.php');

$router->delete('/groups','groups/destroy.php');

$router->get('/expenses','expenses/show.php');

$router->get('/expenses/create','expenses/create.php');
$router->post('/expenses','expenses/store.php');

$router->post('/expenses/edit','expenses/edit.php');
$router->patch('/expenses','expenses/update.php');

$router->delete('/expenses','expenses/destroy.php');