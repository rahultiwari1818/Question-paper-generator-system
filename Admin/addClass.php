<?php 

    session_start();

    include("../Partials/connection.php");
    if(!isset($_SESSION["uId"]) || $_SESSION["role"]!="ADMIN"){
        header("location:../login.php");
        exit;
    }


    $className = "";
    $classErr  = "";
    $error = false;
    if(isset($_POST["addhojabhai"]) && $_POST["addhojabhai"] == "Add"){
        $className = $_POST["class"];
        $className = trim($className);
        
        if(empty($className)){
            $classErr  = "Please Enter ClassName .!";
            $error = true;
        }
        if(!$error){

        }
    }

    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Class</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../script/script.js"></script>
    <script src="../script/jquery-3.6.3.js"></script>
</head>
<body style="background:url('../Assets/images/background.jpg')">

    <h2 class="text-2xl text-center p-5 text-white">Add New Class </h2>
    <div class="flex justify-center items-center">
        <div class=" p-10 rounded-xl shadow-xl bg-blue-500">
            <form action="addClass.php" method="post">
                <div>
                    <input type="text" name="class" id="className"  value="<?php echo $className;?>" required  placeholder="Class Name" class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"  onkeyup="checkClassExists()">
                    <?php
                        if($classErr){
                            echo "<p class='text-red-500 my-3 '> $classErr </p>";
                        }
                    ?>
                </div>
                <div class="my-5">
                    <input type="submit" value="Add" name="addhojabhai" class="px-5 w-full py-2 bg-white text-red-500 border border-red-500 hover:bg-red-500 hover:text-white rounded-lg shadow-xl">
                </div>
            </form>
        </div>
    </div>
</body>
</html>