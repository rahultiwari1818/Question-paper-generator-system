<?php
    session_start();

    include("../Partials/connection.php");


    if(!isset($_SESSION["uId"]) || $_SESSION["role"]!="ADMIN"){
        header("location:../login.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../script/jquery-3.6.3.js"></script>
    <script src="../script/script.js"></script>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

    <main class="">
        <section class=" flex justify-center items-center my-10 overflow-scroll">
                <section class="bg-white p-5 mx-5   rounded-xl shadow ">

                    <table class="p-5  text-black rounded-xl border ">
                        <thead>
                        <tr>
                            <th  class="p-[10px] border">Sr No</th>
                            <th class="p-[10px] border">FirstName</th>
                            <th class="p-[10px] border">LastName</th>
                            <th class="p-[10px] border">Phone No.</th>
                            <th class="p-[10px] border">E-mail</th>
                            <th class="p-[10px] border">Gender</th>
                            <th class="p-[10px] border">Username</th>
                            <th class="p-[10px] border"></th>
                            <th class="p-[10px] border"></th>
                        </tr>
                        </thead>
                        <tbody id="viewUsersTbody">
        
                        </tbody>
                    </table>
                </section>
        </section>
    </main>
    

    <script type="text/javascript">
        $(document).ready(()=>{
            fetchUsers();
        })
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