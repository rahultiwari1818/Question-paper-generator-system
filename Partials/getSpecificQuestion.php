<?php
    header("Allow-Origin-Access-Content:*");
    include("./connection.php");
    try {
        $qid = $_GET["qid"];
        $sql = "select * from tbl_questions where qId = $qid";

        $result = mysqli_query($conn,$sql);

        $arr = array();
        while($row = mysqli_fetch_assoc($result)){
            $arr[] = $row;
        }

        echo json_encode(["status"=>200,"result"=>true,"data"=>$arr,"message"=>"Question Fetched Successfully.!"]);


    } catch (\Throwable $th) {
        
        http_response_code(500);
        echo json_encode(["status"=>500,"message"=>"Internal Server Error.!","result"=>false]);
    }
?>