<?php
namespace Core;
use PDO;
class Database
{
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    public function query($val, $params = [])
    {
        $this->statement = $this->connection->prepare($val);
        $this->statement->execute($params);
        return $this;
    }
    public function get(){
        return $this->statement->fetchAll();
    }
    public function find(){
        return $this->statement->fetch();
    }
    public function findOrFail(){
        $result=$this->find();
        if(!$result){
            abort();
        }
        return $result;
    }

    public function select($table, $columns = ['*'], $where = []) {
        $columnList = implode(", ", $columns);
        $sql = "SELECT $columnList FROM $table";
        //dd($sql);
        if (!empty($where)) {
            $whereClause = implode(" AND ", array_map(fn($key) => "$key = :$key", array_keys($where)));
            $sql .= " WHERE $whereClause";
        }
        //dd($whereClause);
        $statement = $this->connection->prepare($sql);
        $statement->execute($where);
        return $statement->fetchAll();
    }

    public function insert($table,$data){
        $columns=implode(',',array_keys($data));
        //dd($columns);
        $placeholders=implode(', :',array_keys($data));
        //dd($placeholders);
        $sql="INSERT INTO $table ($columns) VALUES (:$placeholders)";
        //dd($sql);
        $this->statement = $this->connection->prepare($sql);
        $this->statement->execute($data);
    }

    public function update($table, $data, $id) {
        $set = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));
        //dd($set);
        $sql = "UPDATE $table SET $set WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        //$data['id'] = $id;
        return $stmt->execute(['id'=>$id] + $data);
    }

    public function delete($table, $id) {
        $sql = "DELETE FROM $table WHERE id = :id";
        $this->statement = $this->connection->prepare($sql);
        $this->statement->execute(['id' => $id]);
    }
}
?>