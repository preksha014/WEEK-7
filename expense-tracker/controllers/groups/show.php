<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$groups = $db->select('groups') ?? [];

if (!empty($_GET['fetch'])) {
    header('Content-Type: application/json');
    echo json_encode($groups);
    exit;
}

view("groups/show.view.php", [
    'heading' => 'Groups',
    'groups' => $groups,
]);
?>