<?php
    session_start();
    header("Access-Control-Allow-Origin:*");

    include("./connection.php");
    if(!isset($_SESSION["uId"]) || $_SESSION["role"]!="ADMIN"){
        header("location:../login.php");
        exit();
    }

    try {
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData,true);
        $id = $data["id"];

        $sql = "delete from tbl_questions where uId=$id";

        if(mysqli_query($conn,$sql)){
            $sql = "delete from tbl_users where uId=$id";
            if(mysqli_query($conn,$sql)){
                echo json_encode(["status"=>200,"message"=>"User Deleted Successfully.!","result"=>true]);
            }
            else{

            }

        }
        else{

        }




    } catch (\Throwable $th) {
        
        http_response_code(500);
        echo json_encode(["status"=>500,"message"=>"Internal Server Error.!","result"=>false]);
    }
?>