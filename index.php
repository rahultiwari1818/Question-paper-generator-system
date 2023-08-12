<?php 

    include("./Partials/connection.php");

    $sql = "select * from tbl_users";
    $result = mysqli_query($conn,$sql);

    if($result->num_rows >= 1){
        header("location: login.php");
    }


    $fname = "";
    $lname = "";
    $email = "";
    $phno = "" ;
    $gender = "";
    $username = "";
    $password = "";
    $fnameErr = "";
    $lnameErr = "";
    $emailErr = "";
    $phnoErr = "";
    $usernameErr = "";
    $passwordErr = "";
    $genderErr = "";

    if(isset($_POST["setUpKrnahaiBhai"]) && $_POST["setUpKrnahaiBhai"] == "Complete Set Up"){
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $phno = $_POST["phno"];
        $password = $_POST["password"]; 
        $valid = true;


        if(isset($_POST["gender"])){
            $gender = $_POST["gender"];
        }
        else{
            $genderErr = "Please Select Your Gender.!";
            $valid = false;
        }

        $fname = trim($fname);
        $lname = trim($lname);
        $username = trim($username);
        $email = trim($email);
        $phno = trim($phno);
        $password = trim($password);
        if(empty($fname)){
            $fnameErr = "First Name Can Not be Empty.!";
            $valid = false;
        }
        if(empty($lname)){
            $lnameErr = "Last Name Can Not be Empty.!";
            $valid = false;
        }
        if(empty($username)){
            $usernameErr = "User Name Can Not be Empty.!";
            $valid = false;
        }
        if(empty($email)){
            $emailErr = "Email Can Not be Empty.!";
            $valid = false;
        }
        if(empty($phno)){
            $phnoErr = "Phone Number Can Not be Empty.!";
            $valid = false;
        }
        if(empty($password)){
            $passwordErr = "Password Can Not be Empty.!";
            $valid = false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $valid = false;
        }
        if(!preg_match('/^[0-9]{10}+$/', $phno) ){
            $phnoErr = "Mobile Number Should Have 10 Digits Only.!";
            $valid = false;
        }

        // $sql = "select * from tbl_users where username = '$username'";
        // $result = $conn->query($sql);

        // if($result->num_rows >=1){
        //     $usernameErr = "Username Already Exists.!";
        //     $valid = false;
        // }

        if($valid){
            try {
                $password = password_hash($password,1);
                $sql = "insert into tbl_users values(NULL,'$fname','$lname','ADMIN','$phno','$email','$gender','$username','$password')";
                if($conn->query($sql) == TRUE){
                    header("location: login.php");         
                }
                else{
                    echo $conn->error;
                    
                }
            } catch (\Throwable $th) {
                //throw $th;
                echo "error";
            }
            
        }
        
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
<body  style="background:url('./Assets/images/background.jpg')">
    <p class="text-2xl  text-center p-5 text-white">Set Up an Admin Account First</p>
    <div class="flex justify-center items-center   ">
            <form action="index.php" method="post" class="p-16  lg:p-24 bg-blue-400 rounded-2xl shadow-2xl">
                <div class="md:flex justify-between gap-10 items-start">
                    <div>
                            <div class="my-4">
                                <label for="fname" class="text-white">First Name :</label>
                                <br>
                                <input type="text" name="fname" value="<?php echo $fname;?>" placeholder="Enter  First Name " class="p-2 my-2 rounded-lg shadow-lg" required>
                                <?php
                                    if($fnameErr){
                                        echo "<p class='text-red-500 my-3 '> $fnameErr </p>";
                                    }
                                ?>
                            </div>

                            <div class="my-4">
                                <label for="lname" class="text-white">Last Name :</label>
                                <br>
                                <input type="text" name="lname" value="<?php echo $lname;?>" placeholder="Enter Last Name  " class="p-2 my-2 rounded-lg shadow-lg" required>
                                <?php
                                    if($lnameErr){
                                        echo "<p class='text-red-500 my-3 '> $lnameErr </p>";
                                    }
                                ?>
                            </div>
                            <div class="my-4">
                                <label for="username" class="text-white">Username :</label>
                                <br>
                                <input type="text" name="username" value="<?php echo $username;?>" placeholder="Enter  Username " class="p-2 my-2 rounded-lg shadow-lg" required>
                                <?php
                                    if($usernameErr){
                                        echo "<p class='text-red-500 my-3 '> $usernameErr </p>";
                                    }
                                ?>
                            </div>  
                            <div class="my-4">
                                <label for="gender" class="text-white">Gender :</label>
                                <br>
                                <?php
                                    if(!$gender){
                                        echo '
                                        <label for="gender">Male : <input type="radio" name="gender" value="male" ></label>
                                        <label for="gender">Female : <input type="radio" name="gender" value="female"></label>
                                        ';
                                    }
                                    else{
                                        if($gender=="male"){

                                            echo '   Male:<input type="radio" name="gender" value="male" id="male" checked>
                                            Female:<input type="radio" name="gender" value="female" id="female" >';
                                                   }
                                                   else{
                       
                                            echo '   Male:<input type="radio" name="gender" value="male" id="male" >
                                            Female:<input type="radio" name="gender" value="female" id="female" checked >';
                                                   }
                                               
                                    }
                                ?>

                                <?php
                                    if($genderErr){
                                        echo "<p class='text-red-500 my-3 '> $genderErr </p>";
                                    }
                                ?>
                            </div> 
                    </div>
                    <div>

                    <div class="my-4">
                                <label for="email" class="text-white">E-Mail :</label>
                                <br>
                                <input type="email" name="email" value="<?php echo $email;?>" placeholder="Enter E-Mail " class="p-2 my-2 rounded-lg shadow-lg" required>
                                <?php
                                    if($emailErr){
                                        echo "<p class='text-red-500 my-3 '> $emailErr </p>";
                                    }
                                ?>
                            </div>

                        <div class="my-4">
                                <label for="phno" class="text-white">Phone Number :</label>
                                <br>
                                <input type="phno" name="phno" value="<?php echo $phno;?>" placeholder="Enter Phone Number " class="p-2 my-2 rounded-lg shadow-lg" required>
                                <?php
                                    if($phnoErr){
                                        echo "<p class='text-red-500 my-3 '> $phnoErr </p>";
                                    }
                                ?>
                            </div>
                        
                        <div  class="my-4">
                            <label for="password"  class="text-white">Password :</label>
                            <br>
                            <input type="password" name="password"  value="<?php echo $password;?>" placeholder="Enter  Password " class="p-2 my-2 rounded-lg shadow-lg" required>
                            <?php
                                if($passwordErr){
                                    echo "<p class='text-red-500 my-3 '> $passwordErr </p>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center p-5">
                    <input type="submit" name="setUpKrnahaiBhai" value="Complete Set Up" class="px-5 py-2 bg-white text-red-500 border border-red-500 hover:bg-red-500 hover:text-white rounded-lg shadow-lg">
                </div>
            </form>
    </div>
</body>
</html>