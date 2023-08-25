<?php
    session_start();
    header("Access-Control-Allow-Origin:*");

    include("./connection.php");
    if(!isset($_SESSION["uId"]) || $_SESSION["role"]!="ADMIN"){
        header("location:../login.php");
        exit();
    }


    try {

        $email = $_GET["email"];

        $sql = "select * from tbl_users where email='$email'";

        $result = mysqli_query($conn,$sql);

        if($result->num_rows >0){
            echo json_encode(["status"=>200,"result"=>true,"message"=>"Email Already Exists","exists"=>true]);
            
        }
        else{
            echo json_encode(["status"=>200,"result"=>true,"message"=>"Email does not Exists","exists"=>false]);
        }

    } catch (\Throwable $th) {
        //throw $th;

        http_response_code(500);
        echo json_encode(["status"=>500,"result"=>false,"message"=>"Some Error Occured"]);
    }
?>