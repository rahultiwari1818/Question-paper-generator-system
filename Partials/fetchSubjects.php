<?php 
    session_start();
    header("Access-Control-Allow-Origin:*");
    include("./connection.php");

    if(!isset($_SESSION["uId"])){
        header("location:../login.php");
        exit();
    }
    try {
        
        $sql = "select a.*,b.class from tbl_subjects a,tbl_class b where a.cId=b.cId";
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