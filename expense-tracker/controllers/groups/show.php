<?php
use Core\Database;

error_reporting(E_ALL);
ini_set('display_errors', 1);

$config = require base_path('config.php');
$db = new Database($config['database']);

// Fetch groups from database
$groups = $db->select('groups') ?? [];

if (!empty($groups) && !is_array(reset($groups))) { 
    $groups = [$groups];
}

// Debug: Check if data is coming
// echo "<pre>";
// print_r($groups);
// echo "</pre>";
// exit;

// Pass groups to the view
view("groups/show.view.php", [
    'heading' => 'Groups',
    'groups' => $groups,
]);
?>
