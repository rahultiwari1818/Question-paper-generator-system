<?php

    include("../Partials/connection.php");
    $question = "" ;
    $type="";
    $level = "";
    $class = "";
    $sub = "";
    $weightage = "";
    $questionErr="";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Questions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../script/jquery-3.6.3.js"></script>
</head>
<body style="background:url('../Assets/images/background.jpg')">
    <?
        include("../Partials/navbar.php");
    ?>

    <main class="mt-5 ">
        <section class="flex justify-center items-center ">
        
            <form action="uploadQuestions.php" method="post" class="bg-white shadow-xl rounded-xl p-10">
                <div class="my-2">
                    <select name="type" id="type" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                        <div class="bg-white p-2">
                            <option value=""  <?php if($type=="") echo "selected";?>> ------- Select a Question Type ----------</option>
                            <option value="mcqs" <?php if($type=="mcqs") echo "selected";?>> MCQS </option>
                            <option value="fib" <?php if($type=="fib") echo "selected";?>> Fill In The Blanks</option>
                            <option value="tf"> <?php if($type=="tf") echo "selected";?>True Or False</option>
                            <option value="atf" <?php if($type=="atf") echo "selected";?>> Answer The Following Question. </option>
                        </div>
                    </select>
                </div>
                <div class="my-2">
                    <textarea name="question" placeholder="Enter your Question"  class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300 resize-none  shadow-lg h-32 w-[80vw] lg:w-[50vw]" value="<?php echo $question;?>"></textarea>
                    <?php
                        if($questionErr){
                            echo "<p class='text-red-500 my-3 '> $questionErr </p>";
                        }
                    ?>
                </div>
                <div class="my-2" id="option-div">
                        <input type="text" name="opt1"  placeholder="Option1" class="block shadow-xl  my-1  appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"> 
                        <input type="text" name="opt2" placeholder="Option2" class="block shadow-xl my-1  appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                        <input type="text" name="opt3" placeholder="Option3" class="block shadow-xl my-1  appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                        <input type="text" name="opt4" placeholder="Option4" class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                </div>
                <div class="my-2">
                    <select name="level" id="level" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                        <div class="bg-white my-2">
                            <option value=""  <?php if($level=="") echo "selected"; ?>>-------- Select Level of Your Question -----------</option>
                            <option value="easy" <?php if($level=="easy") echo "selected"; ?>>Easy</option>
                            <option value="medium" <?php if($level=="medium") echo "selected"; ?>>Medium</option>
                            <option value="hard" <?php if($level=="hard") echo "selected"; ?>>Hard</option>
                        </div>
                    </select>
                </div>
                <div class="my-2">
                    <input type="number" name="weightage" value="<?php echo $weightage;?>" class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" placeholder="Weightage ">
                </div>
                <div class="my-2">
                    <select name="class" id="class" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                        <div class="bg-white my-2">
                            <option value=""  <?php if($class=="") echo "selected"; ?>>-------- Select Class -----------</option>
                            <option value="fy"    <?php if($class=="fy") echo "selected"; ?>>FY</option>
                            <option value="sy"   <?php if($class=="sy") echo "selected"; ?>>SY</option>
                            <option value="ty"   <?php if($class=="ty") echo "selected"; ?>>TY</option>
                        </div>
                    </select>
                </div>
                <div class="my-2">
                    <select name="sub" id="sub" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                        <div class="bg-white my-2">
                            <option value=""   <?php if($sub=="") echo "selected"; ?>>-------- Select Subject -----------</option>
                            <option value="501">AWD</option>
                            <option value="502">Network Technology</option>
                            <option value="503">WFS</option>
                            <option value="504">ASP.Net</option>
                            <option value="505">Unix</option>
                        </div>
                    </select>
                </div>
                <input type="submit" value="Add" class="px-5 w-full py-2 bg-white text-red-500 border border-red-500 hover:bg-red-500 hover:text-white rounded-lg shadow-xl">
            </form>
        </section>
    </main>

    <script type="text/javascript">
        $(document).ready(()=>{
            $("#option-div").hide();
            $("#type").change(()=>{
                if($("#type").val() == "mcqs"){
                    $("#option-div").show();
                }
                else{
                    $("#option-div").hide();
                }
            })
        })
    </script>
</body>
</html>
