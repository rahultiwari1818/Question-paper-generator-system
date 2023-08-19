<?php

    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
     
    require '../vendor/autoload.php';
    include("../Partials/connection.php");


    if(!isset($_SESSION["uId"]) || $_SESSION["role"]!="ADMIN"){
        header("location:../login.php");
        exit();
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
    $successfull = false;
    try {
        if(isset($_POST["submithojabhai"]) && $_POST["submithojabhai"] == "Create User"){
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
    
    
            if($valid){
                try {
                    $password = password_hash($password,1);
                    $sql = "insert into tbl_users values(NULL,'$fname','$lname','USER','$phno','$email','$gender','$username','$password')";
                    if($conn->query($sql) == TRUE){
                        //Code to Mail credentials to user   
                        $successfull = true;
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
                       
                         
                        // $mail = new PHPMailer(true);
                         
                        // try {
                        //     $mail->SMTPDebug = 2;                                      
                        //     $mail->isSMTP();                                           
                        //     $mail->Host       = 'smtp.gfg.com;';                   
                        //     $mail->SMTPAuth   = true;                            
                        //     $mail->Username   = '';                
                        //     $mail->Password   = 'password';                       
                        //     $mail->SMTPSecure = 'tls';                             
                        //     $mail->Port       = 587; 
                         
                        //     $mail->setFrom('from@gfg.com', 'Name');          
                        //     $mail->addAddress('receiver1@gfg.com');
                        //     $mail->addAddress('receiver2@gfg.com', 'Name');
                              
                        //     $mail->isHTML(true);                                 
                        //     $mail->Subject = 'Subject';
                        //     $mail->Body    = 'HTML message body in <b>bold</b> ';
                        //     $mail->AltBody = 'Body in plain text for non-HTML mail clients';
                        //     $mail->send();
                        //     echo "Mail has been sent successfully!";
                        // } catch (Exception $e) {
                        //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        // }


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
    
    } catch (\Throwable $th) {
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
<body>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../script/jquery-3.6.3.js"></script>
    <script src="../script/script.js"></script>
    <link rel="stylesheet" href="../style/style.css">
    
</head>
<body>


    <?php
        
        include("../Partials/navbar.php");


        if($successfull){
            echo "
            <section class='p-[1vw] w-[100vw]  bg-green-500 absolute top-0 shadow-xl' id='successMessage'>
            <p class='  absolute lg:top-5 md:top-4 top-3  right-5 cursor-pointer' onclick='removeMsg()'>
                <img src='../Assets/Icons/close.svg' alt='Close Icon'/>
             </p>
        
                    <p class='flex justify-center items-center'> User added Successfully</p>
                </section>
            ";
        }
    ?>

    


    <div class="flex justify-center items-center   ">
            <form action="createUser.php" method="post" class="p-16  lg:p-24 bg-blue-400 rounded-2xl shadow-2xl">
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
                                <input type="text" id="username" name="username" value="<?php echo $username;?>" placeholder="Enter  Username " class="p-2 my-2 rounded-lg shadow-lg" onkeyup="checkUsernameExists()" required>
                                <p class='text-red-500 my-3 ' id='usernameErr'>      </p>
                                <?php
                                    if($usernameErr){
                                        echo "<p class='text-red-500 my-3 ' > $usernameErr </p>";
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
                                <input type="email" id="userEmail" name="email" value="<?php echo $email;?>" placeholder="Enter E-Mail " class="p-2 my-2 rounded-lg shadow-lg" required onkeyup="checkEmailExists()">
                                <p class='text-red-500 my-3 ' id='userEmailErr'>      </p>
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
                    <input type="submit" id="submitBtn" name="submithojabhai" value="Create User" class="px-5 py-2 bg-white text-red-500 border border-red-500 hover:bg-red-500 hover:text-white rounded-lg shadow-lg">
                </div>
            </form>
    </div>

        <!--------------------------------------------------------- PreLoader ---------------------------------------------------- -->

        <div id="preLoader" class="absolute h-[100vh] w-[100vw] top-0 bg-white"></div>

    <!--------------------------------------------------------- ------------------------------- ---------------------------------------------------- -->




    <script>
        $(document).ready(()=>{
            $("#preLoader").hide();


            // Set Time Out to remove message Automatically after 3 seconds
            setTimeout(()=>{
                removeMsg();
            },3000)
        })
    </script>


    <!-- Script to Prevent Form Submission during Page Reload -->

    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>



<footer class="bg-white bottom-0 p-[1vh] absolute w-screen ">
            <section class="flex justify-center items-center">
                <p class="font-serif antialiased font-black lg:text-xl text-base	"></p>
                Developed With <img src="../Assets/Icons/HeartIcon.svg" class="h-5 w-5 mx-2" alt="Heart Icon">
                 By Team LinkedList
            </section>
        </footer>


    
</body>
</html>