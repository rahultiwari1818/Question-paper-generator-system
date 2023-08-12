<?php
    header("Access-Control-Allow-Origin:*");
    include("./connection.php");
    $username = $_GET["username"];
    try {
        
        $sql = "select * from tbl_users where username = '$username'";
        $result = mysqli_query($conn,$sql);
        
        if($result->num_rows >0){
            echo json_encode(["status"=>200,"result"=>true,"message"=>"Username Already Exists","exists"=>true]);
            
        }
        else{
            echo json_encode(["status"=>200,"result"=>true,"message"=>"Username does not Exists","exists"=>false]);
        }

    } catch (\Throwable $th) {
        //throw $th;
        http_response_code(500);
        echo json_encode(["status"=>500,"result"=>false,"message"=>"Some Error Occured"]);

    }
    
?>