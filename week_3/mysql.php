<?php

require_once "DatabaseInterface.php";

class DatabaseIntraction implements DatabaseInterface{

    private $conn;
    private $table;
    private PDO $pdo;
    private $query;
    private $executed_query;
    private $parameters = [];

    public function __construct($connection){
        $this->conn = $connection;
        $this->pdo = $this->conn->getConnection();
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function table(string $table) : DatabaseInterface {
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            throw new InvalidArgumentException("Invalid table name");
        }
        $this->table = $table;
        return $this;
    }

    public function select(array $cols = ['*']) : DatabaseInterface {
        $colums = implode(",", $cols);
        $this->query = "SELECT $colums FROM $this->table";
        return $this;
    }

    public function where(string $val1, string $val2, string $operation = '=') : DatabaseInterface{
        $user_inputs =" WHERE $val1 $operation ?";
        $this->query .= $user_inputs;
        $this->parameters[] = $val2;
        return $this;
    }

    public function exec(): bool{
        try {
            $stmt = $this->pdo->prepare($this->query);
            $this->executed_query = $stmt->execute(array_values($this->parameters));
            return true;
        } catch (\Throwable $e) {
            return "Error: " . $e->getMessage();
            return false;
        }
    }

    public function fetch(){
        try {
            $response = $this->executed_query->fetch();
            return $response;
        } catch (Throwable $th) {
            throw new Exception("Error Processing Request");
        }
    }

	public function fetchAll(){
        try {
            $response = $this->executed_query->fetchAll();
            return $response;
        } catch (\Throwable $th) {
            throw new Exception("Error Processing Request");
        }
    }

    public function insert(array $fields) : DatabaseInterface{
        $columns = implode(", ", array_keys($fields));
        $placeholders = implode(", ", array_fill(0, count($fields), '?'));
        $this->query = "INSERT INTO " . $this->table . " ($columns) VALUES ($placeholders)";
        $this->parameters = $fields;
        return $this;
    }

    public function update(array $fields) : DatabaseInterface{
        $column = implode(", ", array_keys($fields));
        $placeholders = implode(", ", array_fill(0, count($fields), '?'));
        $this->query = "UPDATE $this->table SET $column = $placeholders";
        $this->parameters = $fields;
        return $this;
    }
}

?>