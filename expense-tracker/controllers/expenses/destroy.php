<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

//Fetch particular expense by id from the database
$expense = $db->query('select * from expenses where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

//Delte that expense from the database
$db->query('delete from expenses where id = :id', [
    'id' => $_POST['id']
]);

header('location: /expenses');
exit();