<?php
use Core\Database;

header('Content-Type: application/json');

$config = require base_path('config.php');
$db = new Database($config['database']);

try {
    $groups = $db->select('groups');
    
    // Transform the data to include emoji
    $groups = array_map(function($group) {
        $group['emoji'] = getGroupEmoji($group['name']);
        return $group;
    }, $groups);
    
    echo json_encode(['success' => true, 'groups' => $groups]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to fetch groups']);
}