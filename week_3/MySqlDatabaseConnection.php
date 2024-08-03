<?php
require_once "DatabaseConnectionInterface.php";

class MySqlDatabaseConnection implements DatabaseConnectionInterface {
    private static $instance = null;
    private $connection;

    public function __construct($host, $dbname, $username, $password) {
        $dsn = "mysql:host=$host;dbname=$dbname";
        try {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            throw new Exception("Connection failed: " . $error->getMessage());
        }
    }

    public static function getInstance($host = '127.0.0.1', $dbname = 'test', $username = 'root', $password = '') {
        if (self::$instance == null) {
            self::$instance = new MySqlDatabaseConnection($host, $dbname, $username, $password);
        }
        return self::$instance;
    }

    public function getConnection() : PDO {
        return $this->connection;
    }
}




?>