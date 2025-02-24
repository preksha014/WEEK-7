<?php
use Core\Database;
use Core\Validator;

header('Content-Type: application/json');

$config = require base_path('config.php');
$db = new Database($config['database']);

// find the corresponding group
$expense=$db->select('expenses',['*'],['id'=>$_POST['id']]);
// $expense = $db->query('select * from expenses where id = :id', [
//     'id' => $_POST['id']
// ])->findOrFail();

// validate the form
$errors = [];

// if no validation errors, update the record in the expense database table.
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Update the expense
$db->update('expenses', [
    'name' => $_POST['name'],
    'amount' => $_POST['amount'],
    'date' => $_POST['date'],
    'group_id' => $_POST['group_id'],
    'id' => $_POST['id']
], $_POST['id']);

// $db->query('UPDATE expenses SET name = :name, amount = :amount, date = :date, group_id = :group_id WHERE id = :id', [
//     'name' => $_POST['name'],
//     'amount' => $_POST['amount'],
//     'date' => $_POST['date'],
//     'group_id' => $_POST['group_id'], // Use the fetched group ID
//     'id' => $_POST['id']
// ]);

// redirect the user
// header('location: /expenses');
// die();
echo json_encode(['success'=> true]);
exit;
?>