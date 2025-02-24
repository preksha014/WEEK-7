<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $groupId = $_POST['id'];

    // Check if group exists
    $group = $db->select('groups', ['*'], ['id' => $groupId]);

    if (!$group) {
        echo json_encode(["status" => "error", "message" => "Group not found"]);
        exit;
    }

    // Delete group
    $db->delete('groups',  $groupId);

    echo json_encode(["status" => "success", "message" => "Group deleted successfully"]);
    exit;
}

echo json_encode(["status" => "error", "message" => "Invalid request"]);
exit;
?>