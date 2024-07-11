<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:*');

include 'C:\xampp\htdocs\api demo\includes\config.php';

$data = json_decode(file_get_contents("php://input"),true);

$student_id = $data['s_id'];



$sql_get = "SELECT *FROM studentinfo WHERE id = {$student_id}";

$conn_pdo->connectionEstablish("student");

$conn = $conn_pdo->getConnectionInstance();

try{

    $getStudents = $conn->prepare($sql_get);
    $getStudents->execute();
    $result = $getStudents->fetchAll(\PDO::FETCH_ASSOC);
    if(count($result) > 0){
        echo json_encode($result);
    }else{
        echo json_encode(array('status'=>false,'message'=>'No record found.'));
    }

}
catch(PDOException $e)
{echo "Error: " . $sql_get . "<br>" . $conn_pdo->error;}


?>