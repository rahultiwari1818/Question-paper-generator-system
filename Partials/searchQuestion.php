<?php
    session_start();
    header("Access-Control-Allow-Origin:*");
    include("./connection.php");
    try {
        $str = $_GET["question"];
        $type = $_GET["type"];
        $class = $_GET["class"];
        $subject = $_GET["subject"];
        $uid = $_SESSION["uId"];
        $role = $_SESSION["role"];
        $uidStr = "uId = $uid";

        if($role=="ADMIN"){
            $uidStr = "";
        }

        $str = strtolower($str);
        $str = trim($str);
        if(empty($str) && empty($type) && empty($class) && empty($subject)){
            if(empty($uidStr)){
                $sql = "select a.*,b.class,c.subject from tbl_questions a,tbl_class b,tbl_subjects c where a.subId=c.sId and a.classId=b.cId";
            }
            else{

                $sql = "select a.*,b.class,c.subject from tbl_questions a,tbl_class b,tbl_subjects c where a.subId=c.sId and a.classId=b.cId and $uidStr ";
            }
            $result = mysqli_query($conn,$sql);
            $arr = array();
            while($row = $result->fetch_assoc()){
                    $arr[] = $row;
            }
            echo json_encode(["status"=>200,"data"=>$arr,"result"=>true]);
        }
        else if(empty($type)){

            if(empty($uidStr)){
                $sql = "select a.*,b.class,c.subject from tbl_questions a,tbl_class b,tbl_subjects c where a.subId=c.sId and a.classId=b.cId";
            }
            else{

                $sql = "select a.*,b.class,c.subject from tbl_questions a,tbl_class b,tbl_subjects c where a.subId=c.sId and a.classId=b.cId and $uidStr ";
            }
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
            if(empty($uidStr)){
                $sql = "select a.*,b.class,c.subject from tbl_questions a,tbl_class b,tbl_subjects c where a.subId=c.sId and a.classId=b.cId and a.q_type = '$type'";
            }
            else{

                $sql = "select a.*,b.class,c.subject from tbl_questions a,tbl_class b,tbl_subjects c where a.subId=c.sId and a.classId=b.cId and a.q_type = '$type' and   $uidStr";
            }
            $result = mysqli_query($conn,$sql);
            $arr = array();
            while($row = $result->fetch_assoc()){
                $arr[] = $row;
            }
            echo json_encode(["status"=>200,"data"=>$arr,"result"=>true]);
        }
        else{
            if(empty($uidStr)){
                $sql = "select a.*,b.class,c.subject from tbl_questions a,tbl_class b,tbl_subjects c where a.subId=c.sId and a.classId=b.cId and a.q_type = '$type'";
            }
            else{

                $sql = "select a.*,b.class,c.subject from tbl_questions a,tbl_class b,tbl_subjects c where a.subId=c.sId and a.classId=b.cId and a.q_type = '$type' and   $uidStr";
            }
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