<?php
        include("../Partials/connection.php");
        $type = "";
        $class = "";
        $subject = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Questions</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../script/script.js"></script>
    <script src="../script/jquery-3.6.3.js"></script>
    <link rel="stylesheet" href="../style/style.css">
    
</head>
<body>



        <section class='p-[1vw] w-[100vw]  bg-green-500 absolute top-0 shadow-xl' id='successQDMessage'>
                <p class='  absolute lg:top-5 md:top-4 top-3  right-5 cursor-pointer' onclick='removeQDMsg()'>
                <img src='../Assets/Icons/close.svg' alt='Close Icon'/>
            </p>
        
                    <p class='flex justify-center items-center'> Question Deleted Successfully</p>
        </section>  

    <main>
        <section class="flex   justify-center items-center m-5 ">
            <section class="overflow-scroll">
            <select name="type" id="viewtype" class="my-2 mx-2 shadow-xl appearance-none  py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"  onchange="searchQuestion()">
                            <div class="bg-white p-2">
                                <option value=""  <?php if($type=="") echo "selected";?>> ------- Select a Question Type ----------</option>
                                <option value="mcqs" <?php if($type=="mcqs") echo "selected";?>> MCQS </option>
                                <option value="fib" <?php if($type=="fib") echo "selected";?>> Fill In The Blanks</option>
                                <option value="tf"> <?php if($type=="tf") echo "selected";?>True Or False</option>
                                <option value="atf" <?php if($type=="atf") echo "selected";?>> Answer The Following Question. </option>
                            </div>
            </select>
            <select name="type" id="viewClass" class="my-2 mx-2 shadow-xl appearance-none  py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"  onchange="searchQuestion()">
                                <option value=""  <?php if($class=="") echo "selected";?>> ------- Select a Question's Class ----------</option>
                        
            </select>
            <select name="type" id="viewSubject" class="my-2 mx-2 shadow-xl appearance-none  py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"  onchange="searchQuestion()">
                                <option value=""  <?php if($subject=="") echo "selected";?>> ------- Select a Question's Subject ----------</option>
                            
            </select>
            <input type="search" name="search"  id="searchQuestion" placeholder="Search Questions" class="my-2 mx-2 shadow-xl  my-1  appearance-none  py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" onkeyup="searchQuestion()" onblur="searchQuestion()"> 
            <section class=" flex justify-center items-center bg-white rounded-xl shadow p-5 mx-5 my-10 overflow-scroll">

                <table class="p-5  text-black rounded-xl border ">
                    <thead>
                    <tr>
                        <th  class="p-[10px] border">Sr No</th>
                        <th class="p-[10px] border">Question Type</th>
                        <th class="p-[10px] border">Question</th>
                        <th class="p-[10px] border">Options</th>
                        <th class="p-[10px] border">Chapter</th>
                        <th class="p-[10px] border">Subject</th>
                        <th class="p-[10px] border">Class</th>
                        <th class="p-[10px] border">Level</th>
                        <th class="p-[10px] border">WeightAge</th>
                        <th class="p-[10px] border">Date Added</th>
                        <th class="p-[10px] border"></th>
                        <th class="p-[10px] border"></th>
                    </tr>
                    </thead>
                    <tbody id="questionsTbody">
            
                    </tbody>
                </table>
            </section>
            </section>

        </section>
    </main>





    <!--------------------------------------------------------- Delete Confirmation Modal ---------------------------------------------------- -->

    <div class="flex justify-center items-center top-0 w-[100vw] h-[100vh] absolute bg-opacity-80  bg-gray-100" id="deleteCnfBox">
        <div class="p-10 bg-white shadow-2xl rounded-xl border border-blue-500">
            <p class="text-xl text-black text-center">Are You Sure To Delete This Question Permanently?</p>
            <div class="flex justify-around my-5 gap-10">

                <button class="px-7 rounded-lg shadow-xl py-3 outline outline-blue-500 text-blue-500 hover:text-white hover:bg-blue-500" onclick="closeDeleteModal()">Cancel</button>
                <button class="px-7 rounded-lg shadow-xl py-3 outline outline-red-500 text-red-500 hover:text-white hover:bg-red-500" onclick="deleteQuestion()">Delete</button>
            </div>
        </div>

    </div>

     <!--------------------------------------------------------- ------------------------------- ---------------------------------------------------- -->


     <!--------------------------------------------------------- Update Modal ---------------------------------------------------- -->

<!-- 
    <div class="flex justify-center items-center top-0 w-[100vw] h-[100vh] absolute bg-opacity-80  bg-gray-100" id="updateModal">
        <div class="p-10 shadow-2xl rounded-xl h-[80vh] overflow-scroll border">
                
            <div class="flex justify-around my-5 gap-10">
                <button class="px-7 rounded-lg shadow-xl py-3 outline outline-blue-500 text-blue-500 hover:text-white hover:bg-blue-500" onclick="closeUpdateModal()">Cancel</button>
                <button class="px-7 rounded-lg shadow-xl py-3 outline outline-red-500 text-red-500 hover:text-white hover:bg-red-500" onclick="deleteQuestion()">Delete</button>
            </div>
        </div>

    </div> -->

     <!--------------------------------------------------------- ------------------------------- ---------------------------------------------------- -->

         <!--------------------------------------------------------- PreLoader ---------------------------------------------------- -->



         <div id="preLoader" class="absolute h-[100vh] w-[100vw] top-0 bg-white"></div>

    <!--------------------------------------------------------- ------------------------------- ---------------------------------------------------- -->


    <script type="text/javascript">
            $("#deleteCnfBox").hide();
            $("#updateModal").hide();
            $("#successQDMessage").hide();
            $(document).ready(()=>{
                fetchClassesInSubject
                searchQuestion();
                fetchClassesInSubject();
                $("#preLoader").hide();
                $("#viewClass").change(()=>{
                    $("#viewSubject").attr("disabled",false);
                    fetchSubjectsForView();
                })
                
                $("#viewSubject").change(()=>{
                                    
                })
                $("#viewSubject").attr("disabled",true);
            })
    </script>

<footer class="bg-white bottom-0  p-[1vh] fixed w-screen ">
            <section class="flex justify-center items-center">
                <p class="font-serif antialiased font-black lg:text-xl text-base	"></p>
                Developed With <img src="../Assets/Icons/HeartIcon.svg" class="h-5 w-5 mx-2" alt="Heart Icon">
                 By Team LinkedList
            </section>
        </footer>

</body>
</html>