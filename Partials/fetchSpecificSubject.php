<?php
    session_start();
    header("Allow-Control-Access-Origin:*");
    include("./connection.php");
    if(!isset($_SESSION["uId"]) || $_SESSION["role"]!="ADMIN"){
        header("location:../login.php");
        exit();
    }

    try {
        //code...
        $id = $_GET["id"];
        $sql = "select a.*,b.* from tbl_subjects a,tbl_class b where a.cId=b.cId and a.sId = $id";
        $result = mysqli_query($conn,$sql);
        while( $row = $result->fetch_assoc()){
            $arr[] = $row;
        }

        echo json_encode(["status"=>200,"result"=>true,"data"=>$arr,"message"=>"Subject Fetched Successfully.!"]);

    } catch (\Throwable $th) {
        //throw $th;
        http_response_code(500);
        echo json_encode(["status"=>500,"result"=>false,"message"=>"Some Error Occured"]);
    }
?>