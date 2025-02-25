<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

try {
    //Fetch particular expense by id from the database
    $expense = $db->select('expenses', ['*'], ['id' => $_POST['id']]);
    
    if (!$expense) {
        echo json_encode(['success' => false, 'message' => 'Expense not found']);
        exit();
    }

    // Delete that expense from the database
    $db->delete('expenses', $_POST['id']);
    
    // Return success response
    echo json_encode(['success' => true]);
    exit();
    
} catch (Exception $e) {
    // Return error response
    echo json_encode(['success' => false, 'message' => 'Failed to delete expense']);
    exit();
}