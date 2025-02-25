<?php
use Core\Database;
use Core\Validator;

$config = require base_path('config.php');
$db = new Database($config['database']);

// find the corresponding group
$expense=$db->select('expenses',['*'],['id'=>$_POST['id']]);

// validate the form
$errors = [];

// if no validation errors, update the record in the expense database table.
if (!empty($errors)) {
    return view('expenses/edit.view.php', [
        'heading' => 'Edit Expense',
        'errors' => $errors,
        'expense' => $expense,
    ]);
}

// Update the expense
$db->update('expenses', [
    'name' => $_POST['name'],
    'amount' => $_POST['amount'],
    'date' => $_POST['date'],
    'group_id' => $_POST['group_id'],
    'id' => $_POST['id']
], $_POST['id']);

// redirect the user
header('location: /expenses');
die();