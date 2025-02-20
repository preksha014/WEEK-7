<?php
use Core\Database;
$config = require base_path('config.php');
$db = new Database($config['database']);

$groups=$db->query("SELECT * FROM groups")->get();


view("groups/show.view.php",[
    'heading'=>'Groups',
    'groups'=>$groups,
]);