<?php
    header("Access-Control-Allow-Origin:*");
    include("./connection.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    $id = $data["id"];

    $sql = "delete from tbl_questions where qId = $id";
    $result = $conn -> query($sql);
    if($result == TRUE){
        echo json_encode(["status"=>200,"message"=>"record deleted successfully.!","result"=>true]);
    }
    else{
        http_response_code(400);
        echo json_encode(["status"=>400,"message"=>"Error Occured.!","result"=>false]);
    }


?>