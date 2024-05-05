<?php

header('Content-type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
class Student
{
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'students');
    }

    public function create()
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            return json_encode([
                "code" => 201,
                "message" => $_SERVER['REQUEST_METHOD']. " Method is not allowed, Only POST Method is allowed",
            ]);
        }

        $data = json_decode(file_get_contents("php://input"), true);

        $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $email = $data['email'];
        $gender = $data['gender'];

        $isInserted = $this->conn->query("INSERT INTO users (firstName, lastName, email, gender) values ('$firstName', '$lastName','$email','$gender')");

        if($isInserted){
            $id = $this->conn->insert_id;
            $row = $this->conn->query("SELECT * FROM users where id = $id");
            $response = $row->fetch_assoc();

            echo json_encode($response);
        } else {
            echo json_encode([
                'message' => 'Failed to Insert Data',
                'code' => 422,
            ]);
        }
    }
}
$create = new student();

echo $create->create($_POST);
?>