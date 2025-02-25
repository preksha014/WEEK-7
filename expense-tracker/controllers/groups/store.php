<?php
use Core\Database;
use Core\Validator;
$config = require base_path('config.php');
$db = new Database($config['database']);

$groups=$db->select('groups');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];
    if (!Validator::string($_POST['name'], 1, 1000)) {
        $errors['name'] = "Name is required";
    }

    $existingGroup=$db->select('groups',['*'],['name'=>$_POST['name']]);

    if ($existingGroup) {
        $errors['duplicate'] = "This group name already exists.";
    }

    $db->insert('groups',['name' => $_POST['name']]);

}

header('location: /groups');