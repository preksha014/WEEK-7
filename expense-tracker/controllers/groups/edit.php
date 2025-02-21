<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$groups = $db->query('select * from groups where id = :id', [
    'id' => $_POST['id']
])->findOrFail();
//dd($_GET['id']);
// dd($groups);

view("groups/edit.view.php", [
    'heading' => 'Edit Group',
    'errors' => [],
    'groups' => $groups
]);