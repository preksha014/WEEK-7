<?php
use Core\Database;
use Core\Validator;

header('Content-Type: application/json');

$config = require base_path('config.php');
$db = new Database($config['database']);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];

    // Validate input
    if (!Validator::string($_POST['name'], 1, 1000)) {
        $errors['name'] = "Name is required";
    }

    // Check for duplicate group name
    $existingGroup = $db->select('groups', ['*'], ['name' => $_POST['name']]);
    if ($existingGroup) {
        $errors['duplicate'] = "This group name already exists.";
    }

    // If errors exist, return JSON response
    if (!empty($errors)) {
        echo json_encode(['status' => 'error', 'errors' => $errors]);
        exit;
    }

    // Insert new group
    $db->insert('groups', ['name' => $_POST['name']]);

    // Return success response
    echo json_encode(['status' => 'success', 'message' => 'Group added successfully']);
    exit;
}