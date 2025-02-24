<?php
use Core\Database;
use Core\Validator;
$config = require base_path('config.php');
$db = new Database($config['database']);

$groups=$db->select('groups');
// $groups=$db->query("SELECT * FROM groups")->get();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header("Content-Type: application/json");
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
        echo json_encode(['status' => 'error', 'errors' => $errors]);
    }
    //dd($_POST);
    $db->insert('expenses',[
        'name' => $_POST['name'],
        'amount' => $_POST['amount'],
        'date' => $_POST['date'],
        'group_id' =>$_POST['group_id'],
    ]);

    echo json_encode(['status'=> 'success']);
    // $db->query("INSERT INTO expenses(name, amount, group_id, date) VALUES (:name,:amount,:group_id,:date)", [
    //     'name' => $_POST['name'],
    //     'amount' => $_POST['amount'],
    //     'group_id' =>$_POST['group_id'],
    //     'date' => $_POST['date'],
    // ]);
}

header('location: /expenses');