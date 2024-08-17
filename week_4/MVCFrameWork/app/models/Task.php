<?php
class Task {

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllTasks(){
        $this->db->query("SELECT * FROM tasks");
        $results = $this->db->resultset();
        return $results;
    }


    public function updateStatus(bool $status, int $id){
        $this->db->query("UPDATE tasks SET is_done = :is_done WHERE id = :id");
        $this->db->bind(':is_done', $status);
        $this->db->bind(':id', $id);
        if($this->db->execute()){
            return true;
          } else {
            return false;
        }
    }

        public function deleteTask(int $id){
        $this->db->query('DELETE FROM tasks WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }

    public function addTask(string $title, string $description){
        $this->db->query("INSERT INTO tasks (title, description, is_done) VALUES (:title , :description, 0)");
        $this->db->bind(':title', $title);
        $this->db->bind(':description', $description);
        if($this->db->execute()){
            return true;
          } else {
            return false;
        }
    }
}


