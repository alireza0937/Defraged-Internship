<?php

interface DatabaseInterface {
	public function __construct($connection);
	public function table(string $table) : DatabaseInterface;
	public function select(array $cols = ['*']) : DatabaseInterface;
    public function insert(array $fields) : DatabaseInterface;
	public function update(array $fields) : DatabaseInterface;
    public function where(string $val1, string $val2, string $operation = '='): DatabaseInterface;
	public function fetch();
	public function fetchAll();
	public function exec() :bool;
	public function ordering(array $columns, string $condition="ASC") : DatabaseInterface;
	public function limit(int $limit) : DatabaseInterface;
	public function delete() : DatabaseInterface;
	public function join(string $type_of_join, string $second_table, string $table_one_column, string $table_two_column) : DatabaseInterface;
	public function groupBy(string $column);
	public function distinct() : DatabaseInterface;
	public function having(string $condition) : DatabaseInterface;
	public function prepare_and_execute();


}
?>