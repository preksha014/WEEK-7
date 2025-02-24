<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

// Handle AJAX request for fetching groups
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['fetch'])) {
    
    header('Content-Type: application/json');
    
    $groups = $db->select(table: 'groups');
    
    echo json_encode(value: $groups);
    exit;
}


// Normal page rendering
$groups = $db->select('groups');

view("groups/show.view.php", [
    'heading' => 'Groups',
    'groups' => $groups,
]);