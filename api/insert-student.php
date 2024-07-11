<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Autharization,X-Requested-With');


include 'C:\xampp\htdocs\api demo\includes\config.php';

$data = json_decode(file_get_contents("php://input"),true);

$f_name = $data['f_name'];
$l_name = $data['l_name'];
$s_email = $data['s_email'];
$time_stamp_ = null;

$sql_email_duplicate = "SELECT * FROM studentinfo WHERE email = {$s_email}";

$sql_get = "INSERT INTO studentinfo (id,firstname, lastname, email) VALUES('','{$f_name}','{$l_name}','{$s_email}')";

$conn_pdo->connectionEstablish("student");

$conn = $conn_pdo->getConnectionInstance();

try{
    $getStudents = $conn->prepare($sql_get);
    $getStudents->execute();
    $result = $getStudents->fetchAll(\PDO::FETCH_ASSOC);
    if(count($result) > 0){
        echo json_encode(array('status'=>false,'message'=>'Duplicate email found.'));
    }else{
        $insert_sql = $conn->prepare($sql_get);
        $insert_sql->execute();
        echo json_encode(array('status'=>true,'message'=>'Record added successfully.'));
    }
}
catch(PDOException $e){
    echo json_encode(array('status'=>false,'message'=>'Failed to add record.'));
}


?>