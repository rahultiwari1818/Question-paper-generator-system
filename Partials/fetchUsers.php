<?php
    session_start();
    header("Access-Content-Allow-Origin:*");

    include("./connection.php");

    if(!isset($_SESSION["uId"]) || $_SESSION["role"]!="ADMIN"){
        header("location:../login.php");
        exit();
    }

    try {

        $sql = "select * from tbl_users where role != 'ADMIN'";
        $result = mysqli_query($conn,$sql);

        $arr = array();
        while( $row = $result->fetch_assoc()){
            $arr[] = $row;
        }

        echo json_encode(["status"=>200,"result"=>true,"data"=>$arr,"message"=>"Users Fetched Successfully.!"]);

    } catch (\Throwable $th) {

        http_response_code(500);
        echo json_encode(["status"=>500,"result"=>false,"message"=>"Some Error Occured"]);

    }
?>