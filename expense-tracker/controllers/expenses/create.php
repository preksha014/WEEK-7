<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

//Fetch all groups from the database
$groups=$db->select('groups');

//Pass the groups to the view
view("expenses/create.view.php", [
    'heading' => 'Add Expense',
    'groups'=>$groups
]);