<?php
use Core\Database;
use Core\Validator;

$config = require base_path('config.php');
$db = new Database($config['database']);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];

    if (!Validator::string($_POST['name'], 1, 1000)) {
        $errors['name'] = "Name is required";
    }

    $existingGroup = $db->select('groups', ['*'], ['name' => $_POST['name']], true);
    if ($existingGroup) {
        $errors['duplicate'] = "This group name already exists.";
    }

    if (!empty($errors)) {
        echo json_encode(['status' => 'error', 'errors' => $errors]);
        exit;
    }

    $db->insert('groups', ['name' => $_POST['name']]);

    echo json_encode(['status' => 'success', 'message' => 'Group added successfully']);
    exit;
}
