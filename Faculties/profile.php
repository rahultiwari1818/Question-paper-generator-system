<?php
    session_start();
    include("../Partials/connection.php");


    if(!isset($_SESSION["uId"])){
        header("location: ../login.php");
        exit();
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../script/jquery-3.6.3.js"></script>
    <script src="../script/script.js"></script>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <?php
                    include("../Partials/navbar.php");

                    $uid = $_SESSION["uId"];

                    $sql = "select * from tbl_users where uId = $uid";
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($result);
                    $fname =  $row["fname"]; 
                    $lname =  $row["lname"]; 
                    $username =  $row["username"]; 
                    $email =  $row["email"]; 
                    $phno =  $row["phno"]; 
                    $role =  $row["role"]; 
                    $institute =  $row["institute_name"]; 
                    $gender =  $row["gender"]; 

    ?>

<main>
        <section class="flex justify-center items-center   px-2 my-5">

            <div id="profile" class="  p-2 max-w-2/3 min-w-fit md:p-5 bg-blue-500 shadow-xl rounded-2xl">

                <div class="bg-white  sm:flex items-center justify-center flex-col gap-y-3 rounded-2xl">

                    <div class="w-full flex items-center justify-center flex-col py-1 px-10 py-5 ">
                        <h1
                            class="block text-center text-2xl font-bold text-black px-20 py-1 my-1 border-b-2 border-gray-300 sm: py-4 my-5 md:text-3xl ">
                            <?php echo $username;?>
                        </h1>
                        <b class="text-center md:text-md w-full text-lg">Welcome !! <?php echo $username;?></b>
                    </div>

                    <div class="w-full py-3 ">
                        <p class="text-center text-xl text-red-500 bg-gray-200  shadow-xl p-2 font-bold">Your Profile</p>
                    </div>
                    
                    <div class="flex flex-col justify-evenly items-left sm:gap-y-3 my-5 items-left">

                        <div class="block border-b-2 border-gray-200 sm:grid grid-cols-2 gap-5 px-5 ">
                            <div class="py-1 my-1">
                                <p class="text-md font-bold sm:text-md text-center md:text-lg "> Fname &nbsp; : </p>
                            </div>
                            <div class="py-1 px-5 text-left">
                                <p class="text-md block text-center sm:text-md md:text-lg"> <?php echo $fname;?></p>
                            </div>
                        </div>

                        <div class="block border-b-2 border-gray-200 sm:grid grid-cols-2 gap-5 px-5 ">
                            <div class="py-1 my-1">
                                <p class="text-center font-bold text-md sm:text-md md:text-lg"> Lname &nbsp; : </p>
                            </div>
                            <div class="py-1 px-5">
                                <p class="text-md text-center sm:text-md md:text-lg"> <?php echo $lname;?></p>
                            </div>
                        </div>

                        <div class="block border-b-2 border-gray-200 sm:grid grid-cols-2 gap-5 px-5">
                            <div class="py-1 my-1">
                                <p class="text-md font-bold sm:text-md text-center md:text-lg"> Email &nbsp; : </p>
                            </div>
                            <div class="py-1 px-5">
                                <p class="text-md break-all text-center sm:text-md md:text-lg"> <?php echo $email;?></p>
                            </div>
                        </div>

                        <div class="block border-b-2 border-gray-200 sm:grid grid-cols-2 gap-5 px-5">
                            <div class="py-1 my-1">
                                <p class="text-md font-bold sm:text-md text-center md:text-lg"> Role &nbsp; : </p>
                            </div>
                            <div class="py-1 px-5">
                                <p class="text-md text-center sm:text-md md:text-lg"> <?php echo $role;?></p>
                            </div>
                        </div>

                        <div class="block border-b-2 border-gray-200 sm:grid grid-cols-2 gap-5 px-5">
                            <div class="py-1 my-1">
                                <p class="text-md font-bold sm:text-md text-center md:text-lg"> Phone No &nbsp; : </p>
                            </div>
                            <div class="py-1 px-5">
                                <p class="text-md text-center sm:text-md md:text-lg"> <?php echo $phno;?></p>
                            </div>
                        </div>

                        <div class="block border-b-2 border-gray-200 sm:grid grid-cols-2 gap-5 px-5">
                            <div class="py-1 my-1">
                                <p class="text-md font-bold sm:text-md text-center md:text-lg"> Gender &nbsp; : </p>
                            </div>
                            <div class="py-1 px-5">
                                <p class="text-md text-center sm:text-md md:text-lg"><?php echo $gender; ?></p>
                            </div>
                        </div>

                    </div>
                    <div class="w-full py-3 ">
                        <p class="text-center text-xl text-red-500 bg-gray-200 p-2 shadow-xl font-bold ">Thank You</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="bg-white bottom-0  p-[1vh] fixed w-screen  ">
            <section class="flex justify-center items-center">
                <p class="font-serif antialiased font-black lg:text-xl text-base	"></p>
                Developed With <img src="../Assets/Icons/HeartIcon.svg" class="h-5 w-5 mx-2" alt="Heart Icon">
                 By Team LinkedList
            </section>
        </footer>

</body>
</html>