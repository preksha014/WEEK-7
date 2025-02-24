<?php
use Core\Database;


$config = require base_path('config.php');
$db = new Database($config['database']);

//Fetch particular expense by id from the database
$expense=$db->select('expenses',['*'],['id'=>$_POST['id']]);
// dd($expense);
// $expense = $db->query('select * from expenses where id = :id', [
//     'id' => $_POST['id']
// ])->findOrFail();

// Delete that expense from the database
$db->delete('expenses',$_POST['id']);
// $db->query('delete from expenses where id = :id', [
//     'id' => $_POST['id']
// ]);

header('location: /expenses');
exit();
?>