<?php
use Core\Database;
use Core\Validator;
$config = require base_path('config.php');
$db = new Database($config['database']);

$groups=$db->select('groups');
// $groups = $db->query("select * from groups")->get();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];
    if (!Validator::string($_POST['name'], 1, 1000)) {
        $errors['name'] = "Name is required";
    }

    $existingGroup=$db->select('groups',['*'],['name'=>$_POST['name']]);
    // $existingGroup = $db->query("
    // SELECT id FROM groups WHERE name = :name", [
    //     'name' => $_POST['name']
    // ])->get();

    if ($existingGroup) {
        $errors['duplicate'] = "This group name already exists.";
    }

    if (!empty($errors)) {
        return view("groups/create.view.php", [
            'heading' => 'Add Group',
            'errors' => $errors
        ]);
    }

    $db->insert('groups',['name' => $_POST['name'],
    ]);
    
    // $db->query("INSERT INTO groups(name) VALUES(:name)", [
    //     'name' => $_POST['name'],
    // ]);
}

header('location: /groups');