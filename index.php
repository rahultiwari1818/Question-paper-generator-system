<?php 

    include("./Partials/connection.php");

    $sql = "select * from tbl_users";
    $result = mysqli_query($conn,$sql);

    if($result->num_rows > 1){
        header("location: login.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
        
</body>
</html>