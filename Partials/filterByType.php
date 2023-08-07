<?php
    header("Access-Control-Allow-Origin: *");
    include("./connection.php");
    try {
        $type = $_GET["type"];
        $sql = "select * from tbl_questions where q_type = '$type'";
        $result = mysqli_query($conn,$sql);
        $arr = array();
        while($row = $result->fetch_assoc()){
            $arr[] = $row;
        }
        echo json_encode(["status"=>200,"data"=>$arr,"result"=>true]);
    } catch (\Throwable $th) {
        http_response_code(500);
        echo json_encode(["status"=>200,"result"=>false]);
    }

?>

