<?php
    session_start();
    header("Allow-Control-Access-Origin:*");
    include("./connection.php");

    try {
        
        $jsonData = file_get_contents("php://input");

        $data = json_decode($jsonData,true);

        $subId = $data["id"];
        $subject = $data["subject"];
        $type = $data["type"];
        $class = $data["class"];
        $sql = "update tbl_subjects set subject='$subject',type='$type', cId=$class where sId = $subId";
        $result = mysqli_query($conn,$sql);
        if($result){
            echo json_encode(["status"=>200,"message"=>"Subject Updated Successfully.!","result"=>true]);
        }
        else{
            http_response_code(400);
            echo json_encode(["status"=>400,"message"=>"Invalid Data.!","result"=>false]);
        }

    } catch (\Throwable $th) {
        //throw $th;

        http_response_code(500);
        echo json_encode(["status"=>500,"message"=>"Internal Server Error.!","result"=>false]);
    }
?>