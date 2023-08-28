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
<body class="max-h-screen max-w-screen">

    <?php
                include("../Partials/navbar.php");
    ?>

        <section class='p-[1vw] w-[100vw] z-30  bg-green-500 absolute top-0 shadow-xl' id='successUserDeletionMessage'>
            <p class='  absolute lg:top-5 md:top-4 top-3  right-5 cursor-pointer' onclick='removeUDMsg()'>
                <img src='../Assets/Icons/close.svg' alt='Close Icon'/>
             </p>
        
                    <p class='flex justify-center items-center'> User Removed Successfully</p>
        </section>  

    <main class="">
        <section class=" flex justify-center items-center mx-5 my-3">
            <input type="search" name="search"  id="searchUser" placeholder="Search User" class="my-2 mx-2 shadow-xl    appearance-none  py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" onkeyup="searchUser()" onblur="searchUser()"> 
        </section>
        <section class=" flex justify-center items-center mx-5 my-5   ">
                    <section class=" max-h-[80vh] overflow-y-scroll  bg-white rounded-xl shadow p-5">
                        <table class="p-5  text-black rounded-xl border ">
                        <thead class="text-white top-0 sticky">
                        <tr>
                            <th  class="md:p-[10px] p-[5px] border bg-blue-500">Sr No</th>
                            <th class="md:p-[10px] p-[5px] border bg-blue-500">FirstName</th>
                            <th class="md:p-[10px] p-[5px] border bg-blue-500">LastName</th>
                            <th class="md:p-[10px] p-[5px] border bg-blue-500">Phone No.</th>
                            <th class="md:p-[10px] p-[5px] border bg-blue-500">E-mail</th>
                            <th class="md:p-[10px] p-[5px] border bg-blue-500">Gender</th>
                            <th class="md:p-[10px] p-[5px] border bg-blue-500">Username</th>
                            <!-- <th class="md:p-[10px] p-[5px] border bg-blue-500"></th> -->
                            <th class="md:p-[10px] p-[5px] border bg-blue-500"></th>
                        </tr>
                        </thead>
                        <tbody id="viewUsersTbody"  class="max-h-[77vh] overflow-y-scroll">
        
                        </tbody>
                    </table>
                    </section>
            </section>
    </main>



    <!--------------------------------------------------------- Delete Confirmation Modal ---------------------------------------------------- -->

    <div class="flex justify-center items-center top-0 w-[100vw] h-[100vh] absolute bg-opacity-80  bg-gray-100" id="deleteUserCnfModal">
                <div class="p-10 bg-white shadow-2xl rounded-xl border border-blue-500">
                     <p class="text-xl text-black text-center">Are You Sure To Delete This User Permanently?</p>
                     <p class="text-xl text-black text-center">Removing a User Will Subsequently Remove all his Data and Questions.</p>
                     <div class="flex justify-around my-5 gap-10">

                        <button class="px-7 rounded-lg shadow-xl py-3 outline outline-blue-500 text-blue-500 hover:text-white hover:bg-blue-500" onclick="closeUserDeleteModal()">Cancel</button>
                        <button class="px-7 rounded-lg shadow-xl py-3 outline outline-red-500 text-red-500 hover:text-white hover:bg-red-500" onclick="deleteUser()">Delete</button>
                    </div>
                </div>

    </div>

     <!--------------------------------------------------------- PreLoader ---------------------------------------------------- -->



    <div id="preLoader" class="absolute h-[100vh] z-50 w-[100vw] top-0 bg-white"></div>

    <!--------------------------------------------------------- ------------------------------- ---------------------------------------------------- -->


    

    <script type="text/javascript">
        $(document).ready(()=>{
            $("#deleteUserCnfModal").hide();
            $("#successUserDeletionMessage").hide();
            fetchUsers();

            $("#preLoader").hide();

            setTimeout(()=>{
                removeUDMsg();
            },3000)

        })
    </script>


        <footer class="bg-white bottom-0   p-[1vh] fixed w-screen ">
            <section class="flex justify-center items-center">
                <p class="font-serif antialiased font-black lg:text-xl text-base	"></p>
                Developed With <img src="../Assets/Icons/HeartIcon.svg" class="h-5 w-5 mx-2" alt="Heart Icon">
                 By Team LinkedList
            </section>
        </footer>

</body>
</html>