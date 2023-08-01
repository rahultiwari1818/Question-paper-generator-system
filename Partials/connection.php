<?php

    $host = "localhost";
    $database = "QPG";
    $user = "root";
    $password = "";

    $conn = mysqli_connect($host,$user,$password,$database);
    if($conn->connect_error){
        die("Connection Error");
    }
    

?>