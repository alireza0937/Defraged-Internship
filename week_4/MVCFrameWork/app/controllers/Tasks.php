<?php
class Tasks extends Controller {
    
    public function index(){
        $taskModel = $this->model("task");
        $tasks = $taskModel->getAlltasks();
        $data = [
            "tasks"=> $tasks
        ];
        if ($this->request->getMethod() == "POST") {
            $new_status_and_id = $_POST["status"];
            $data = explode("_", $new_status_and_id);
            $acceptable_status= ["0", "1"];
            if (in_array($data[0], $acceptable_status)) {
                $taskModel->updateStatus($data[0], $data[1]);
                redirect("tasks/");
            }
        }
        $this->view("tasks/index", $data);
    }

    public function add(){
        $taskModel = $this->model("task");
        $this->view("tasks/add");
        if ($this->request->getMethod() == "POST") {
            $description = $this->request->getBodyParams()["description"];
            $title = $this->request->getBodyParams()["title"];
            if (empty($title) or empty($description)) {
                exit;
            }
            $taskModel->addTask($title, $description);
        }
    }
    
    public function delete($id){
        $taskModel = $this->model("task");
        $response = $taskModel->deleteTask($id);
        if ($response) {
            redirect("tasks/");
        } else {
            die("Invalid task ID");
        }
    }
}
