<?php
use Core\Database;
use Core\Validator;
$config = require base_path('config.php');
$db = new Database($config['database']);

$groups=$db->query("select * from groups")->get();

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
    // dd($_POST['name']);
    // dd($groups['name']);
    // if(strtoupper($_POST['name'])===strtoupper($groups['name'])){
    //     $errors['name'] = "Name already exists";
    // }   
}

header('location: /groups');