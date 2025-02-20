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
        return view("expenses/create.view.php", [
            'heading' => 'Add Expense',
            'errors' => $errors
        ]);
    }
    $db->query("INSERT INTO expenses(name, amount, group_id, date) VALUES (:name,:amount,:group_id,:date)", [
        
        'name' => $_POST['name'],
        'amount' => $_POST['amount'],
        'group_id' =>$_POST['group'],
        'date' => $_POST['date'],
    ]);
}

header('location: /expenses');