<?php
use Core\Database;

header('Content-Type: application/json');

$config = require base_path('config.php');
$db = new Database($config['database']);

if($_SERVER['REQUEST_METHOD']==='POST' || !isset($_POST['id'])){
    $expenseId=$_POST['id'];

    $expense=$db->select('expenses',['*'],['id'=>$_POST['id']]);

    if(!$expense){
        echo json_encode(['status'=>'error','message'=>'Expense not found']);
        exit();
    }
    $db->delete('expenses',$_POST['id']);

    echo json_encode(['status'=> 'success','message'=> 'Expense deleted successfully']);
    exit();
}
//Fetch particular expense by id from the database
//$expense=$db->select('expenses',['*'],['id'=>$_POST['id']]);
// dd($expense);
// $expense = $db->query('select * from expenses where id = :id', [
//     'id' => $_POST['id']
// ])->findOrFail();

// Delete that expense from the database
// $db->delete('expenses',$_POST['id']);
// $db->query('delete from expenses where id = :id', [
//     'id' => $_POST['id']
// ]);

echo json_encode(['status'=> 'error','message'=> 'Invalid request']);
exit();
?>