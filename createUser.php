<?php

    session_start();

    // if(!isset($_SESSION["uid"])){
    //     header("location:login.php");
    //     exit;
    // }

    $fname = "";
    $lname = "";
    $email = "";
    $phno = "" ;
    $username = "";
    $password = "";
    $fnameErr = "";
    $lnameErr = "";
    $emailErr = "";
    $phnoErr = "";
    $usernameErr = "";
    $passwordErr = "";

    try {
        // if(isset())
    } catch (\Throwable $th) {
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="background:url('./assets/images/background.jpg')">
    <div class="flex justify-center items-center   ">
            <form action="login.php" method="post" class="p-16  lg:p-24 bg-blue-400 rounded-2xl shadow-2xl">
                <div class="md:flex justify-between gap-10 items-start">
                    <div>
                            <div class="my-4">
                                <label for="fname" class="text-white">First Name :</label>
                                <br>
                                <input type="text" name="fname" value="<?php echo $fname;?>" placeholder="Enter  First Name " class="p-2 my-2 rounded-lg shadow-lg">
                                <?php
                                    if($fnameErr){
                                        echo "<p class='text-red-500 my-3 '> $fnameErr </p>";
                                    }
                                ?>
                            </div>

                            <div class="my-4">
                                <label for="lname" class="text-white">Last Name :</label>
                                <br>
                                <input type="text" name="lname" value="<?php echo $lname;?>" placeholder="Enter Last Name  " class="p-2 my-2 rounded-lg shadow-lg">
                                <?php
                                    if($lnameErr){
                                        echo "<p class='text-red-500 my-3 '> $lnameErr </p>";
                                    }
                                ?>
                            </div>
                            <div class="my-4">
                                <label for="username" class="text-white">Username :</label>
                                <br>
                                <input type="text" name="username" value="<?php echo $username;?>" placeholder="Enter  Username " class="p-2 my-2 rounded-lg shadow-lg">
                                <?php
                                    if($usernameErr){
                                        echo "<p class='text-red-500 my-3 '> $usernameErr </p>";
                                    }
                                ?>
                        </div>  

                    </div>
                    <div>

                    <div class="my-4">
                                <label for="email" class="text-white">E-Mail :</label>
                                <br>
                                <input type="email" name="email" value="<?php echo $email;?>" placeholder="Enter E-Mail " class="p-2 my-2 rounded-lg shadow-lg">
                                <?php
                                    if($emailErr){
                                        echo "<p class='text-red-500 my-3 '> $emailErr </p>";
                                    }
                                ?>
                            </div>

                        <div class="my-4">
                                <label for="phno" class="text-white">Phone Number :</label>
                                <br>
                                <input type="email" name="phno" value="<?php echo $phno;?>" placeholder="Enter Phone Number " class="p-2 my-2 rounded-lg shadow-lg">
                                <?php
                                    if($phnoErr){
                                        echo "<p class='text-red-500 my-3 '> $phnoErr </p>";
                                    }
                                ?>
                            </div>
                        
                        <div  class="my-4">
                            <label for="password"  class="text-white">Password :</label>
                            <br>
                            <input type="password" name="password"  value="<?php echo $password;?>" placeholder="Enter  Password " class="p-2 my-2 rounded-lg shadow-lg">
                            <?php
                                if($passwordErr){
                                    echo "<p class='text-red-500 my-3 '> $passwordErr </p>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center p-5">
                    <input type="submit" value="Create User" class="px-5 py-2 bg-white text-red-500 border border-red-500 hover:bg-red-500 hover:text-white rounded-lg shadow-lg">
                </div>
            </form>
    </div>
    
</body>
</html>