<?php
    header("Access-Control-Allow-Origin:*");
    include("./connection.php");
    try {
        $str = $_GET["question"];
        $type = $_GET["type"];
        $str = strtolower($str);
        $str = trim($str);
        if(empty($str) && empty($type)){
            $sql = "select * from tbl_questions";
            $result = mysqli_query($conn,$sql);
            $arr = array();
            while($row = $result->fetch_assoc()){
                    $arr[] = $row;
            }
            echo json_encode(["status"=>200,"data"=>$arr,"result"=>true]);
        }
        else if(empty($type)){
            $sql = "select * from tbl_questions";
            $result = mysqli_query($conn,$sql);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $ques = $row["question"];
                $ques = strtolower($ques);
                if(strpos($ques,$str)){
                    $arr[] = $row;
                }
            }
            echo json_encode(["status"=>200,"data"=>$arr,"result"=>true]);
        }
        else if(empty($str)){
            $sql = "select * from tbl_questions where q_type = '$type'";
            $result = mysqli_query($conn,$sql);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $arr[] = $row;
            }
            echo json_encode(["status"=>200,"data"=>$arr,"result"=>true]);
        }
        else{
            $sql = "select * from tbl_questions where q_type = '$type'";
        $result = mysqli_query($conn,$sql);
        $arr = array();
        while($row = $result->fetch_assoc()){
            $ques = $row["question"];
            $ques = strtolower($ques);
            if(strpos($ques,$str)){
                $arr[] = $row;
            }
        }
        echo json_encode(["status"=>200,"data"=>$arr,"result"=>true]);
        }
    } catch (\Throwable $th) {
        http_response_code(500);
        echo json_encode(["status"=>200,"result"=>false]);
    }
?>