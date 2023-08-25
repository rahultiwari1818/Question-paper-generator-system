<?php
    session_start();
    header("Access-Control-Allow-Origin:*");
    include("./connection.php");
    if(!isset($_SESSION["uId"])){
        header("location:../login.php");
        exit();
    }

    try {
        $id = $_GET["id"];

        $sql = "select * from tbl_class where cId = $id";
        $result = mysqli_query($conn,$sql);
        $arr = array();
        while( $row = $result->fetch_assoc()){
            $arr[] = $row;
        }

        echo json_encode(["status"=>200,"result"=>true,"data"=>$arr,"message"=>"Classes Fetched Successfully.!"]);


    } catch (\Throwable $th) {
        //throw $th;

        http_response_code(500);
        echo json_encode(["status"=>500,"result"=>false,"message"=>"Some Error Occured"]);
    }

?>