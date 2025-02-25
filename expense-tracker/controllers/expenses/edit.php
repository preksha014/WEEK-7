<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$groups=$db->select('groups');
$expense=$db->select('expenses',['*'],['id'=>$_POST['id']])[0];

view("expenses/edit.view.php", [
    'heading' => 'Edit Expense',
    'errors' => [],
    'groups' => $groups,
    'expense' => $expense
]);