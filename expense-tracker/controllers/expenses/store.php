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
    if (!Validator::validateAmount($_POST['amount'])) {
        $errors['amount'] = "Enter valid Amount";
    }
    if (!Validator::validateDate($_POST['date'])) {
        $errors['date'] = "Enter valid Date";
    }
    
    if(empty($_POST['group_id'])){
        $errors['group_id'] = "Please select a group";
    }

    if (!empty($errors)) {
        return view("expenses/create.view.php", [
            'heading' => 'Add Expense',
            'errors' => $errors,
            'groups'=>$groups,
        ]);
    }
    
    $db->insert('expenses',[
        'name' => $_POST['name'],
        'amount' => $_POST['amount'],
        'date' => $_POST['date'],
        'group_id' =>$_POST['group_id'],
    ]);
}

header('location: /expenses');