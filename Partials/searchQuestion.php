<?php
    session_start();
    header("Access-Control-Allow-Origin:*");
    include("./connection.php");
    // try {
    //     $str = $_GET["question"];
    //     $type = $_GET["type"];
    //     $class = $_GET["class"];
    //     $subject = $_GET["subject"];
    //     $uid = $_SESSION["uId"];
    //     $role = $_SESSION["role"];
    //     $uidStr = "uId = $uid";

    //     if($role=="ADMIN"){
    //         $uidStr = "";
    //     }

    //     $str = strtolower($str);
    //     $str = trim($str);
    //     if(empty($str) && empty($type) && empty($class) && empty($subject)){
    //         if(empty($uidStr)){
    //             $sql = "select a.*,b.class,c.subject from tbl_questions a,tbl_class b,tbl_subjects c where a.subId=c.sId and a.classId=b.cId";
    //         }
    //         else{

    //             $sql = "select a.*,b.class,c.subject from tbl_questions a,tbl_class b,tbl_subjects c where a.subId=c.sId and a.classId=b.cId and $uidStr ";
    //         }
    //         $result = mysqli_query($conn,$sql);
    //         $arr = array();
    //         while($row = $result->fetch_assoc()){
    //                 $arr[] = $row;
    //         }
    //         echo json_encode(["status"=>200,"data"=>$arr,"result"=>true]);
    //     }
    //     else if(empty($type)){

    //         if(empty($uidStr)){
    //             $sql = "select a.*,b.class,c.subject from tbl_questions a,tbl_class b,tbl_subjects c where a.subId=c.sId and a.classId=b.cId";
    //         }
    //         else{

    //             $sql = "select a.*,b.class,c.subject from tbl_questions a,tbl_class b,tbl_subjects c where a.subId=c.sId and a.classId=b.cId and $uidStr ";
    //         }
    //         $result = mysqli_query($conn,$sql);
    //         $arr = array();
    //         while($row = $result->fetch_assoc()){
    //             $ques = $row["question"];
    //             $ques = strtolower($ques);
    //             if(strpos($ques,$str)){
    //                 $arr[] = $row;
    //             }
    //         }
    //         echo json_encode(["status"=>200,"data"=>$arr,"result"=>true]);
    //     }
    //     else if(empty($str)){
    //         if(empty($uidStr)){
    //             $sql = "select a.*,b.class,c.subject from tbl_questions a,tbl_class b,tbl_subjects c where a.subId=c.sId and a.classId=b.cId and a.q_type = '$type'";
    //         }
    //         else{

    //             $sql = "select a.*,b.class,c.subject from tbl_questions a,tbl_class b,tbl_subjects c where a.subId=c.sId and a.classId=b.cId and a.q_type = '$type' and   $uidStr";
    //         }
    //         $result = mysqli_query($conn,$sql);
    //         $arr = array();
    //         while($row = $result->fetch_assoc()){
    //             $arr[] = $row;
    //         }
    //         echo json_encode(["status"=>200,"data"=>$arr,"result"=>true]);
    //     }
    //     else{
    //         if(empty($uidStr)){
    //             $sql = "select a.*,b.class,c.subject from tbl_questions a,tbl_class b,tbl_subjects c where a.subId=c.sId and a.classId=b.cId and a.q_type = '$type'";
    //         }
    //         else{

    //             $sql = "select a.*,b.class,c.subject from tbl_questions a,tbl_class b,tbl_subjects c where a.subId=c.sId and a.classId=b.cId and a.q_type = '$type' and   $uidStr";
    //         }
    //     $result = mysqli_query($conn,$sql);
    //     $arr = array();
    //     while($row = $result->fetch_assoc()){
    //         $ques = $row["question"];
    //         $ques = strtolower($ques);
    //         if(strpos($ques,$str)){
    //             $arr[] = $row;
    //         }
    //     }
    //     echo json_encode(["status"=>200,"data"=>$arr,"result"=>true]);
    //     }
    // } 

    try{
        $str = $_GET["question"];
        $type = $_GET["type"];
        $class = $_GET["class"];
        $subject = $_GET["subject"];
        $uid = $_SESSION["uId"];
        $role = $_SESSION["role"];

        $conditions = array();

        // Always include the uId condition
        if(!empty($uid)){
            $conditions[] = "uId = $uid";
        }

        // Add search string condition
        if (!empty($str)) {
            $str = strtolower(trim($str));
            $conditions[] = "LOWER(question) LIKE '%$str%'";
        }

        // Add type condition
        if (!empty($type)) {
            $conditions[] = "q_type = '$type'";
        }

        // Add class condition
        if (!empty($class)) {
            $conditions[] = "classId = $class";
        }

        // Add subject condition
        if (!empty($subject)) {
            $conditions[] = "subId = $subject";
        }

        // Combine conditions
        $whereClause = "";
        if (!empty($conditions)) {
            $whereClause = "WHERE " . implode(" AND ", $conditions);
        }

        // Construct the SQL query
        $sql = "SELECT a.*, b.class, c.subject 
                FROM tbl_questions a
                JOIN tbl_class b ON a.classId = b.cId
                JOIN tbl_subjects c ON a.subId = c.sId
                $whereClause";

        $result = mysqli_query($conn, $sql);
        $arr = array();
        while ($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        echo json_encode(["status" => 200, "data" => $arr, "result" => true]);

    }
    catch (\Throwable $th) {
        http_response_code(500);
        echo json_encode(["status"=>200,"result"=>false]);
    }
?>