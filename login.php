<?php
    session_start();
    include("./Partials/connection.php");
    $username = "";
    $password = "";
    $usernameErr = "";
    $passwordErr = "";


    if(isset($_SESSION["uId"]) && $_SESSION["role"]=="ADMIN"){
        header("location: ./Admin/createUser.php");
        exit();
    }

    if(isset($_SESSION["uId"]) && $_SESSION["role"]=="USER"){
        header("location: ./Faculties/uploadQuestions.php");
        exit();
    }


    if(isset($_POST["loginhojabhai"]) && $_POST["loginhojabhai"]=="Login"){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = "select * from tbl_users where username = '$username'";
        $result = $conn -> query($sql);
        $valid = true;
        if($result->num_rows != 1 ){
            $usernameErr = "Incorrect Username.!";
            $valid = false;
        }
        if($valid){
            $row = $result->fetch_assoc();
            $hashedPasswd = $row["password"];
            if(!password_verify($password,$hashedPasswd)){
                $passwordErr = "Incorrect Password.!";
            }
            else{
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["role"] = $row["role"];
                $_SESSION["uId"] = $row["uId"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["fname"] = $row["fname"];
                if($row["role"]=="ADMIN"){
                    header("location: ./Admin/createUser.php");
                    exit();
                }
                else{
                    header("location : ./Faculties/uploadQuestions.php");
                    exit();
                }
            }

            
        }



    }

    try {

    } catch (\Throwable $th) {
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="background:url('./Assets/images/background.jpg')">
    <div class="flex justify-center items-center  h-[90vh] ">
            <form action="login.php" method="post" class="p-16  lg:p-24 bg-blue-400 rounded-2xl shadow-2xl">
                <div class="flex justify-center items-center">
                    <div>
                        <div class="my-4">
                            <label for="username" class="text-white">Username</label>
                            <br>
                            <input type="text" name="username" value="<?php echo $username;?>" placeholder="Enter Your Username " class="p-2 my-2 rounded-lg shadow-lg">
                            <?php
                                if($usernameErr){
                                    echo "<p class='text-red-500 my-3 '> $usernameErr </p>";
                                }
                            ?>
                        </div>
                        <div  class="my-4">
                            <label for="password"  class="text-white">Password</label>
                            <br>
                            <input type="password" name="password"  value="<?php echo $password;?>" placeholder="Enter Your Password " class="p-2 my-2 rounded-lg shadow-lg">
                            <?php
                                if($passwordErr){
                                    echo "<p class='text-red-500 my-3 '> $passwordErr </p>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center p-5">
                    <input type="submit" name="loginhojabhai" value="Login" class="px-5 py-2 bg-white text-red-500 border border-red-500 hover:bg-red-500 hover:text-white rounded-lg shadow-lg">
                </div>
            </form>
    </div>
    
</body>
</html>