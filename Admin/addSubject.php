<?php 
    session_start();

    include("../Partials/connection.php");


    if(!isset($_SESSION["uId"]) || $_SESSION["role"]!="ADMIN"){
        header("location:../login.php");
        exit();
    }

    $subject = "";
    $type = "";
    $class = "";
    $classErr = "";
    $typeErr = "";
    $subjectErr = "";
    $error = false;
    $successfull = false;


    if(isset($_POST["addhojabhai"]) && $_POST["addhojabhai"] == "Add"){
        $class = $_POST["class"];
        $subject = $_POST["subject"];
        $type = $_POST["type"];

        $subject = trim($subject);
        $subject = addslashes($subject);

        if(empty($subject)){
            $subjectErr = "Subject Can Not be Empty";
            $error = true;
        }

        if(empty($class)){
            $error = true;
        }

         if(empty($type)){
            $error = true;
         }

        if(!$error){
            $sql = "insert into tbl_subjects values(NULL,'$subject','$type',$class)";

            $result = mysqli_query($conn,$sql);

            if($result == TRUE){
                $successfull = true;
                $subject = "";
                $type = "";
                $class = "";
                $classErr = "";
                $typeErr = "";
                $subjectErr = "";
            }
        }

        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject</title>
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
            
                        <p class='flex justify-center items-center'> Subject added Successfully</p>
                    </section>
                ";
            }
    ?>




    <h2 class="text-2xl text-center p-5 text-white">Add New Subject </h2>

    <div class="flex justify-center items-center">
        <div class=" p-10 rounded-xl shadow-xl bg-blue-500">
            <form action="addSubject.php" method="post">
                <div class="my-2">
                    <input type="text" name="subject" id="subject"  value="<?php echo $subject;?>" required  placeholder="Subject Name" class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"  onkeyup="checkSubjectExists()">
                    <p class='text-red-500 my-3 ' id='subjectErr'>      </p>
                   <?php
                        if($subjectErr){
                            echo "<p class='text-red-500 my-3 '> $subjectErr </p>";
                        }
                    ?>
                </div>
                <div class="my-2">
                <select name="type" value="<?php echo $type;?>" required id="sub" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                        <div class="bg-white my-2">
                            <option value=""   <?php if($type=="") echo "selected"; ?>>-------- Select type -----------</option>
                            <option value="Practical"  <?php if($type=="Practical") echo "selected"; ?> >Practical</option>
                            <option value="Theory"  <?php if($type=="Theory") echo "selected"; ?>>Theory</option>
                        </div>
                    </select>
                    <?php
                        if($typeErr){
                            echo "<p class='text-red-500 my-3 '> $typeErr </p>";
                        }
                    ?>
                </div>
                <div class="my-2">
                <select name="class" value="<?php echo $class;?>" required id="classInSubject" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                        <div class="bg-white my-2">

                        </div>
                    </select>
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
            <h2 class="text-white text-2xl text-center"> List Of Existing Subjects</h2>
            <div class="flex justify-center items-center my-5">
                        <table class="text-white">
                            <thead class="text-xl">
                                <tr>
                                    <td class="border p-[10px]">Sr NO</td>
                                    <td class="border p-[10px]">Subject</td>
                                    <td class="border p-[10px]">Class</td>
                                    <td class="border p-[10px]"></td>
                                    <td class="border p-[10px]"></td>
                                    
                                </tr>
                            </thead>
                            <tbody id="subjectTableTbody" class="text-lg">
        
                            </tbody>
                        </table>
            </div>

            
        </div>

    <!--------------------------------------------------------- Delete Confirmation Modal ---------------------------------------------------- -->

        
        <div class="flex justify-center items-center top-0 w-[100vw] h-[100vh] absolute bg-opacity-80  bg-gray-100" id="deleteSubjectCnfBox">
                <div class="p-10 bg-white shadow-2xl rounded-xl border border-blue-500">
                    <p class="text-xl text-black text-center">Are You Sure To Delete This Subject Permanently?</p>
                    <div class="flex justify-around my-5 gap-10">
        
                        <button class="px-7 rounded-lg shadow-xl py-3 outline outline-blue-500 text-blue-500 hover:text-white hover:bg-blue-500" onclick="closeSubjectDeleteModal()">Cancel</button>
                        <button class="px-7 rounded-lg shadow-xl py-3 outline outline-red-500 text-red-500 hover:text-white hover:bg-red-500" onclick="deleteSubject()">Delete</button>
                    </div>
                </div>
        </div>
    <!--------------------------------------------------------- PreLoader ---------------------------------------------------- -->

        <div id="preLoader" class="absolute h-[100vh] w-[100vw] top-0 bg-white"></div>

    <!--------------------------------------------------------- ------------------------------- ---------------------------------------------------- -->



                     


    <script type="text/javascript">

        $("#deleteSubjectCnfBox").hide();   

        $(document).ready(()=>{
            
            fetchClassesInSubject();
            fetchSubjects();
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