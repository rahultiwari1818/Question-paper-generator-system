<?php 
    header("Access-Content-Allow-Origin:*");

    include("./connection.php");

    if(!isset($_SESSION["uId"])){
        header("location:../login.php");
        exit();
    }

    try {
        $class = $_GET["class"];
        if(empty($class)){
            echo json_encode(["status"=>200,"result"=>true,"data"=>array(),"message"=>"Subjects Fetched Successfully.!"]);
            exit();
        }
        $sql = "select * from tbl_subjects where cId = $class";
        $result = mysqli_query($conn,$sql);
        $arr = array();
        while( $row = $result->fetch_assoc()){
            $arr[] = $row;
        }

        echo json_encode(["status"=>200,"result"=>true,"data"=>$arr,"message"=>"Subjects Fetched Successfully.!"]);

    } catch (\Throwable $th) {

        http_response_code(500);
        echo json_encode(["status"=>500,"result"=>false,"message"=>"Some Error Occured"]);
    }
?>