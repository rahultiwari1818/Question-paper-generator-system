<?php
    header("Access-Control-Allow-Origin:*");
    include("./connection.php");

    if(!isset($_SESSION["uId"])){
        header("location:../login.php");
        exit();
    }
    try {
    
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        $id = $data["id"];

        $sql = "delete from tbl_questions where qId = $id";
        $result = $conn -> query($sql);
        if($result == TRUE){
            echo json_encode(["status"=>200,"message"=>"Question Deleted Successfully.!","result"=>true]);
        }
        else{
            http_response_code(400);
            echo json_encode(["status"=>400,"message"=>"Error Occured.!","result"=>false]);
        }
    } catch (\Throwable $th) {
        //throw $th;

        http_response_code(500);
        echo json_encode(["status"=>500,"message"=>"Internal Server Error.!","result"=>false]);
    }



?>