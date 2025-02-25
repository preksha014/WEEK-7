<?php
use Core\Database;

header('Content-Type: application/json');

$config = require base_path('config.php');
$db = new Database($config['database']);

try {

    $groups = $db->select('groups', ['*'], ['id' => $_POST['id']]);

    if (!$groups) {
        echo json_encode(['success' => false, 'message' => 'Group not found']);
        exit();
    }

    $db->delete('groups', $_POST['id']);

    echo json_encode(['success' => true, 'message' => 'Group deleted successfully']);
    exit();

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Failed to delete group']);
    exit();
}
?>