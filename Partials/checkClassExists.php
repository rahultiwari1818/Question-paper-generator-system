<?php
    // header("Access-Control-Allow-Origin : *");
    // include("./connection.php");

    header("Access-Control-Allow-Origin:*");
    include("./connection.php");

    $className = $_GET["className"];
    try {

        $sql = "select * from tbl_class where class = '$className'";
        $result = mysqli_query($conn,$sql);
        
        if($result->num_rows >0){
            echo json_encode(["status"=>200,"result"=>true,"message"=>"Class Already Exists","exists"=>true]);
            
        }
        else{
            echo json_encode(["status"=>200,"result"=>true,"message"=>"Class does not Exists","exists"=>false]);
        }


    } catch (\Throwable $th) {
        //throw $th;
        echo $th;
        http_response_code(500);
        echo json_encode(["status"=>500,"result"=>false,"message"=>"Some Error Occured"]);
    }
?>