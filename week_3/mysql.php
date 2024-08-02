<?php

require_once "DatabaseInterface.php";

class DatabaseIntraction implements DatabaseInterface{

    private $conn;
    private $table;
    private PDO $pdo;
    private $query;
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
        $colums = implode(", ", $cols);
        $this->query = "SELECT $colums FROM $this->table";
        return $this;
    }

    public function where(string $column, $value, string $operation = '=') : DatabaseInterface{
        $user_inputs =" WHERE $column $operation ?";
        if ($value == "NULL" and $operation == "IS" or $operation == "IS NOT") {
            $this->query .= " WHERE $column $operation NULL";
            return $this;
        }
        $this->query .= $user_inputs;
        $this->parameters[] = $value;
        return $this;

    }

    public function exec(): bool{
        $stmt = $this->pdo->prepare($this->query);
        $result = $stmt->execute(array_values($this->parameters));
        $this->parameters = [];
        return $result;     
    }

    public function fetch(){
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute(array_values($this->parameters));
        $result = $stmt->fetch();
        $this->parameters = [];
        return $result;

    }

	public function fetchAll(){
        $stmt = $this->pdo->prepare($this->query);
        echo $this->query . PHP_EOL;
        $stmt->execute(array_values($this->parameters));
        $result = $stmt->fetchAll();
        $this->parameters = [];
        return $result;

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

    public function limit(int $limit) : DatabaseInterface{
        $this->query .= " LIMIT $limit";
        return $this;
    }

    public function ordering(array $columns, string $condition="ASC") : DatabaseInterface {
        $all_columns = implode(",", $columns);
        $this->query .= " ORDER BY $all_columns $condition";
        return $this;
    }

    public function delete() : DatabaseInterface {
        $this->query = "DELETE FROM $this->table";
        return $this;
    }

    public function join(string $type_of_join = "INNER", string $second_table, string $table_one_column, string $table_two_column): DatabaseInterface
    {
        $type_of_join = strtoupper($type_of_join);
        if (!in_array($type_of_join, ['INNER', 'LEFT', 'RIGHT', 'FULL OUTER'])) {
            throw new InvalidArgumentException("Invalid join type");
        }
        $user_query = " $type_of_join JOIN $second_table ON $this->table.$table_one_column = $second_table.$table_two_column";
        $this->query .= $user_query;
        return $this;
    }

    public function groupBy(string $column) : DatabaseInterface {
        $this->query .= " GROUP BY $column";
        return $this;
    }

    public function distinct() : DatabaseInterface {
        $this->query = str_replace('SELECT', 'SELECT DISTINCT', $this->query);
        return $this;
    }

    public function having(string $condition) : DatabaseInterface {
        $this->query .= " HAVING $condition";
        return $this;
    }
}

?>