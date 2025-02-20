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

    if (!empty($errors)) {
        return view("groups/create.view.php", [
            'heading' => 'Add Group',
            'errors' => $errors
        ]);
    }
    $db->query("INSERT INTO groups(name) VALUES(:name)", [
        'name' => $_POST['name'],
    ]);
}

header('location: /groups');