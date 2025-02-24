<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$groups=$db->select('groups',['*'],['id'=>$_POST['id']],true);
// $groups = $db->query('select * from groups where id = :id', [
//     'id' => $_POST['id']
// ])->findOrFail();

$db->delete('groups',$_POST['id']);
// $db->query('delete from groups where id = :id', [
//     'id' => $_POST['id']
// ]);

header('location: /groups');
exit();