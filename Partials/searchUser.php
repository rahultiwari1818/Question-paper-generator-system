<?php

    session_start();
    header("Access-Control-Allow-Origin:*");
    include("./connection.php");

    if(!isset($_SESSION["uId"])){
        header("location:../login.php");
        exit();
    }

    try {

        $search_value = $_GET["search"];
        $search_value = strtolower(trim($search_value));

        $sql = "select uId,fname,lname,role,phno,email,gender,username from tbl_users where  role!='ADMIN' and (LOWER(fname) like '%$search_value%' or LOWER(lname) like '%$search_value%' or LOWER(email) like '%$search_value%' or LOWER(phno) like '%$search_value%' or LOWER(username) like '%$search_value%' )";

        $result = mysqli_query($conn,$sql);

        $arr = array();
        while ($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        echo json_encode(["status" => 200,"message"=>"Users Fetched Succesfully.!", "data" => $arr, "result" => true]);


    } catch (\Throwable $th) {


        http_response_code(500);
        echo json_encode(["status"=>500,"message"=>"Internal Server Error.!","result"=>false]);

    }


?>