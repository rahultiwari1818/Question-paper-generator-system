<?php
    header("Access-Control-Allow-Origin:*");
    include("./connection.php");

    try {

        $jsonData = file_get_contents("php://input");

        $data = json_decode($jsonData,true);

        $classId = $data["id"];

        $sql = "delete from tbl_subjects where cId = $classId";

        $result = mysqli_query($conn,$sql);

        if($result == TRUE){

            $sql = "delete from tbl_class where cId = $classId";

            $result = mysqli_query($conn,$sql);

            if($result == TRUE){
                echo json_encode(["status"=>200,"message"=>"Class Deleted Successfully.!","result"=>true]);
            }
        }

    } catch (\Throwable $th) {
        

        http_response_code(500);
        echo json_encode(["status"=>500,"message"=>"Internal Server Error.!","result"=>false]);

    }
?>