<?php 

    session_start();

    include("../Partials/connection.php");
    if(!isset($_SESSION["uId"]) || $_SESSION["role"]!="ADMIN"){
        header("location:../login.php");
        exit();
    }


    $className = "";
    $classErr  = "";
    $successfull = false;
    $error = false;
    if(isset($_POST["addhojabhai"]) && $_POST["addhojabhai"] == "Add"){
        $className = $_POST["class"];
        $className = trim($className);
        
        if(empty($className)){
            $classErr  = "Please Enter ClassName .!";
            $error = true;
        }
        if(!$error){
            $sql = "insert into tbl_class values(NULL,'$className')";
            $result = mysqli_query($conn,$sql);
            if($result == TRUE){
                $successfull = true;
                $className= "";
                $classErr="";
            }
            else{
                $successfull = true;
            }
        }
    }

    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../script/jquery-3.6.3.js"></script>
    <script src="../script/script.js"></script>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

    <?php 
        if($successfull){
            echo "
                <section class='p-[1vw] w-[100vw]  bg-green-500 absolute top-0 shadow-xl' id='successMessage'>
                <p class='  absolute lg:top-5 md:top-4 top-3  right-5 cursor-pointer' onclick='removeMsg()'>
                <img src='../Assets/Icons/close.svg' alt='Close Icon'/>
            </p>
        
                    <p class='flex justify-center items-center'> Class added Successfully</p>
                </section>
            ";
        }
    ?>

    <h2 class="text-2xl text-center p-5 text-white">Add New Class </h2>
    <div class="flex justify-center items-center">
        <div class=" p-10 rounded-xl shadow-xl bg-blue-500">
            <form action="addClass.php" method="post">
                <div>
                    <input type="text" name="class" id="className"  value="<?php echo $className;?>" required  placeholder="Class Name" class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"  onkeyup="checkClassExists()">
                    <p class='text-red-500 my-3 ' id='classNameErr'>      </p>
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
    <div class="my-5">
            <h2 class="text-white text-2xl text-center"> List Of Existing Classes</h2>
            <div class="flex justify-center items-center my-5 mx-5 ">
                <div class="bg-white rounded-xl shadow p-5   overflow-scroll">

                    <table class="p-5  text-black rounded-xl border ">
                        <thead class="text-xl">
                            <tr>
                                <td class="border p-[10px]">Sr NO</td>
                                <td class="border p-[10px]">Class</td>
                                <td class="border p-[10px]"></td>
                                <td class="border p-[10px]"></td>
                            </tr>
                        </thead>
                        <tbody id="classTableTbody" class="text-lg">
    
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    

    <!--------------------------------------------------------- Delete Confirmation Modal ---------------------------------------------------- -->

    <div class="flex justify-center items-center top-0 w-[100vw] h-[100vh] absolute bg-opacity-80  bg-gray-100" id="deleteClassCnfBox">
                <div class="p-10 bg-white shadow-2xl rounded-xl border border-blue-500">
                     <p class="text-xl text-black text-center">Are You Sure To Delete This Class Permanently?</p>
                     <div class="flex justify-around my-5 gap-10">

                        <button class="px-7 rounded-lg shadow-xl py-3 outline outline-blue-500 text-blue-500 hover:text-white hover:bg-blue-500" onclick="closeClassDeleteModal()">Cancel</button>
                        <button class="px-7 rounded-lg shadow-xl py-3 outline outline-red-500 text-red-500 hover:text-white hover:bg-red-500" onclick="deleteClass()">Delete</button>
                    </div>
                </div>

    </div>

     <!--------------------------------------------------------- PreLoader ---------------------------------------------------- -->



    <div id="preLoader" class="absolute h-[100vh] w-[100vw] top-0 bg-white"></div>

    <!--------------------------------------------------------- ------------------------------- ---------------------------------------------------- -->



    <script type="text/javascript">



        $("#deleteClassCnfBox").hide();
        $(document).ready(()=>{
            $("#preLoader").hide();
            displayClassesInTable();

        // Set Time Out to remove message Automatically after 3 seconds
            setTimeout(()=>{
                removeMsg();
            },3000)
            
        })
    </script>


    <!-- Script to Prevent Form Submission during Page Reload -->

    <script type="text/javascript">
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>

        <footer class="bg-white bottom-0  p-[1vh] sticky w-screen ">
            <section class="flex justify-center items-center">
                <p class="font-serif antialiased font-black lg:text-xl text-base	"></p>
                Developed With <img src="../Assets/Icons/HeartIcon.svg" class="h-5 w-5 mx-2" alt="Heart Icon">
                 By Team LinkedList
            </section>
        </footer>



</body>
</html>