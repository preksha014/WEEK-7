<?php
use Core\Database;
use Core\Validator;

$config = require base_path('config.php');
$db = new Database($config['database']);

// find the corresponding group
$groups = $db->query('select * from groups where id = :id', [
    'id' => $_POST['id']
])->findOrFail();


// validate the form
$errors = [];
if (! Validator::string($_POST['name'], 1, 1000)) {
    $errors['name'] = 'Name is required';
}
// if no validation errors, update the record in the notes database table.
if (!empty($errors)) {
    return view('groups/edit.view.php', [
        'heading' => 'Edit Group',
        'errors' => $errors,
        'groups' => $groups
    ]);
}
$db->query('update groups set name = :name where id = :id', [
    'id' => $_POST['id'],
    'name' => $_POST['name']
]);
// redirect the user
header('location: /groups');
die();