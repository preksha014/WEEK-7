<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$groups = $db->select('groups', ['*'], ['id' => $_POST['id']]);

$group = $groups[0]; // Get the first (and should be only) group

view("groups/edit.view.php", [
    'heading' => 'Edit Group',
    'errors' => [],
    'groups' => $group
]);