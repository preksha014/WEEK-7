<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$groups = $db->query('select * from groups where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

$db->query('delete from groups where id = :id', [
    'id' => $_POST['id']
]);

header('location: /groups');
exit();