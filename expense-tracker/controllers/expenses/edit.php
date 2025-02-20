<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$groups=$db->query("SELECT * FROM groups")->get();

$expense = $db->query('select * from expenses where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

view("expenses/edit.view.php", [
    'heading' => 'Edit Group',
    'errors' => [],
    'groups' => $groups,
    'expense' => $expense
]);