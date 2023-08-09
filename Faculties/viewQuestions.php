<?php
        include("../Partials/connection.php");
        $type = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Questions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../script/jquery-3.6.3.js"></script>
    <script src="../script/script.js"></script>
    
</head>
<body>



        <select name="type" id="viewtype" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"  onchange="searchQuestion()">
                        <div class="bg-white p-2">
                            <option value=""  <?php if($type=="") echo "selected";?>> ------- Select a Question Type ----------</option>
                            <option value="mcqs" <?php if($type=="mcqs") echo "selected";?>> MCQS </option>
                            <option value="fib" <?php if($type=="fib") echo "selected";?>> Fill In The Blanks</option>
                            <option value="tf"> <?php if($type=="tf") echo "selected";?>True Or False</option>
                            <option value="atf" <?php if($type=="atf") echo "selected";?>> Answer The Following Question. </option>
                        </div>
        </select>
        <input type="search" name="search"  id="searchQuestion" placeholder="Search Questions" class="block shadow-xl  my-1  appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" onkeyup="searchQuestion()" onblur="searchQuestion()"> 

    <table class="p-5 my-10">
        <thead>
        <tr>
            <th  class="p-[10px] border">Sr No</th>
            <th class="p-[10px] border">Question Type</th>
            <th class="p-[10px] border">Question</th>
            <th class="p-[10px] border">Options</th>
            <th class="p-[10px] border">Level</th>
            <th class="p-[10px] border">WeightAge</th>
            <th class="p-[10px] border">Date Added</th>
        </tr>
        </thead>
        <tbody id="questionsTbody">

        </tbody>
    </table>



    <!--------------------------------------------------------- Delete Confirmation Modal ---------------------------------------------------- -->

    <div class="flex justify-center items-center top-0 w-[100vw] h-[100vh] absolute bg-opacity-80  bg-gray-100" id="deleteCnfBox">
        <div class="p-10 shadow-2xl rounded-xl border border-blue-500">
            <p class="text-xl text-black text-center">Are You Sure To Delete This Question Permanently?</p>
            <div class="flex justify-around my-5 gap-10">

                <button class="px-7 rounded-lg shadow-xl py-3 outline outline-blue-500 text-blue-500 hover:text-white hover:bg-blue-500" onclick="closeDeleteModal()">Cancel</button>
                <button class="px-7 rounded-lg shadow-xl py-3 outline outline-red-500 text-red-500 hover:text-white hover:bg-red-500" onclick="deleteQuestion()">Delete</button>
            </div>
        </div>

    </div>

     <!--------------------------------------------------------- ------------------------------- ---------------------------------------------------- -->


     <!--------------------------------------------------------- Update Modal ---------------------------------------------------- -->


    <div class="flex justify-center items-center top-0 w-[100vw] h-[100vh] absolute bg-opacity-80  bg-gray-100" id="updateModal">
        <div class="p-10 shadow-2xl rounded-xl border">
            <p class="text-xl text-black text-center">Are You Sure To Delete This Question Permanently?</p>
            <div class="flex justify-around my-5 gap-10">

                <button class="px-7 rounded-lg shadow-xl py-3 outline outline-blue-500 text-blue-500 hover:text-white hover:bg-blue-500" onclick="closeDeleteModal()">Cancel</button>
                <button class="px-7 rounded-lg shadow-xl py-3 outline outline-red-500 text-red-500 hover:text-white hover:bg-red-500" onclick="deleteQuestion()">Delete</button>
            </div>
        </div>

    </div>

     <!--------------------------------------------------------- ------------------------------- ---------------------------------------------------- -->



    <script type="text/javascript">
            $("#deleteCnfBox").hide();
            $("#updateModal").hide();
            $(document).ready(()=>{
                searchQuestion();
            })
    </script>
</body>
</html>