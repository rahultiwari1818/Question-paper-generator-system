<?php
    session_start();
    header("Allow-Control-Access-Origin:*");

    include("./connection.php");


    if(!isset($_SESSION["uId"])){
        header("location: ../login.php");
        exit();
    }

    try {
        
        $jsonData = file_get_contents("php://input");

        $data = json_decode($jsonData,true);

        $uId = $_SESSION["uId"];

        $oldPassword = $data["oldPassword"];
        $newPassword = $data["newPassword"];

        $sql = "select * from tbl_users where uId = $uId";

        $result = mysqli_query($conn,$sql);

        $row = mysqli_fetch_assoc($result);

        $password = $row["password"];

        if(password_verify($oldPassword,$password)){

            $newPassword = password_hash($newPassword,1);

            $sql = "update tbl_users set password = '$newPassword' where uId = $uId";

            $result = mysqli_query($conn,$sql);

            if($result == TRUE){
                echo json_encode(["status"=>200,"message"=>"Password Changed Successfully.!","result"=>true]);
            }
            else{

            }

        }
        else{
            echo json_encode(["status"=>200,"message"=>"Invalid Current Password Don't Match.!","result"=>false]);
        }


        

    } catch (\Throwable $th) {
        

        http_response_code(500);
        echo json_encode(["status"=>500,"message"=>"Internal Server Error.!","result"=>false]);

    }


?>

