<?php
use Core\Database;
$config = require base_path('config.php');
$db = new Database($config['database']);

if($_SERVER['REQUEST_METHOD']==='GET' && isset($_GET['fetch'])){
    header('Content-Type: application/json');
    $expenses = $db->query('SELECT e.id, e.name, e.amount, e.date, g.name AS category
                        FROM expenses e
                        JOIN groups g ON e.group_id = g.id
                        ORDER BY e.date DESC')->get();
    echo json_encode($expenses);
    exit;
}

$expenses = $db->query('SELECT e.id, e.name, e.amount, e.date, g.name AS category
                        FROM expenses e
                        JOIN groups g ON e.group_id = g.id
                        ORDER BY e.date DESC')->get();
                        
view("expenses/show.view.php",[
    'heading'=>'Expenses',
    'expenses'=>$expenses,
]);