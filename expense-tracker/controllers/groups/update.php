<?php
use Core\Database;
use Core\Validator;

header('Content-Type: application/json');

$config = require base_path('config.php');
$db = new Database($config['database']);

$errors = [];
if (!Validator::string($_POST['name'], 1, 1000)) {
    $errors['name'] = 'Name is required';
}

if (!empty($errors)) {
    echo json_encode(['success' => false, 'error' => $errors['name']]);
    exit;
}

$db->update('groups', [
    'name' => $_POST['name'],
], $_POST['id']);

echo json_encode(['success' => true]);
exit;
