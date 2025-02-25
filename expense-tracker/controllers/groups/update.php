<?php
use Core\Database;
use Core\Validator;

header('Content-Type: application/json');

$config = require base_path('config.php');
$db = new Database($config['database']);

// find the corresponding group
$groups = $db->select('groups', ['*'], ['id' => $_POST['id']]);

// validate the form
$errors = [];
if (!Validator::string($_POST['name'], 1, 1000)) {
    $errors['name'] = 'Name is required';
}

// Check for duplicate group name
$existingGroup = $db->query(
    "SELECT id FROM groups WHERE name = :name AND id != :id",
    ['name' => $_POST['name'], 'id' => $_POST['id']]
)->get();

if ($existingGroup) {
    $errors['duplicate'] = "This group name already exists.";
}

// if there are validation errors, return them as JSON
if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['errors' => $errors]);
    exit();
}

// Update the group
$db->update('groups', [
    'name' => $_POST['name'],
], $_POST['id']);

// Return success response
echo json_encode(['success' => true]);
exit();