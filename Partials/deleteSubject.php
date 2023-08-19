<?php 
    header("Access-Control-Allow-Origin:*");
    include("./connection.php");

    try {


    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    $id = $data["id"];

    $sql = "delete from tbl_subjects where sId = $id";
    $result = $conn -> query($sql);
    if($result == TRUE){
        echo json_encode(["status"=>200,"message"=>"Subject Deleted Successfully.!","result"=>true]);
    }
    else{

    }
    } catch (\Throwable $th) {

        http_response_code(500);
        echo json_encode(["status"=>500,"message"=>"Internal Server Error.!","result"=>false]);
    }
?>