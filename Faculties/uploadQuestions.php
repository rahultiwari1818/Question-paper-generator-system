<?php

    include("../Partials/connection.php");
    $question = "" ;
    $type="";
    $level = "";
    $class = "";
    $sub = "";
    $weightage = "";
    $option1 = "";
    $option2 = "";
    $option3 = "";
    $option4 = "";
    $options = "";  
    $questionErr="";
    $typeErr = "";
    $levelErr = "";
    $classErr = "";
    $subErr = "";
    $weightageErr = "";
    $optionErr = "";
    $successfull = false;


    if(isset($_POST["addhojabhai"]) && ($_POST["addhojabhai"])=="Add"){
        $question = $_POST["question"] ;
        $type = $_POST["type"];
        $level = $_POST["level"];
        $class = $_POST["class"];
        $sub = $_POST["sub"];
        $weightage = $_POST["weightage"];

        $err = false;

        if(trim($question) == ""){
            $questionErr = "Please Enter a Question *";
            $err = true;
        }
        if(trim($type) == ""){
            $typeErr = "Please Select Question Type *";
            $err = true;
        }
        if(trim($level) == ""){
            $levelErr = "Please Select Question Level *";
            $err = true;
        }
        if(trim($class) == ""){
            $classErr = "Please Select Class *";
            $err = true;
        }
        if(trim($sub) == ""){
            $subErr = "Please Select a Subject *";
            $err = true;
        }
        if(trim($weightage) == ""){
            $weightageErr = "Please Enter Weightage of Question *";
            $err = true;
        }
        if(trim($type)=="mcqs"){
            $option1 = $_POST["opt1"];
            $option2 = $_POST["opt2"];
            $option3 = $_POST["opt3"];
            $option4 = $_POST["opt4"];

            if(trim($option1)=="" || trim($option2)==""  || trim($option3)==""  || trim($option4)=="" ){
                $err = true;
                $optionErr = "Please Enter all the Options.! *";
            }
            $options = $option1 ." , ".$option2 ." , ".$option3 ." , ".$option4;
        }

        if(!$err){
            $question = htmlspecialchars($question);
            $currentDate = date("Y-m-d");
            $sql = "insert into tbl_questions values(NULL,'$question','$type','$options','$level',$weightage,1,1,1,'$currentDate')";
            if($conn->query($sql) === TRUE){
                $successfull = true;
                $question = "" ;
    $type="";
    $level = "";
    $class = "";
    $sub = "";
    $weightage = "";
    $option1 = "";
    $option2 = "";
    $option3 = "";
    $option4 = "";
    $questionErr="";
    $typeErr = "";
    $levelErr = "";
    $classErr = "";
    $subErr = "";
    $weightageErr = "";
    $optionErr = "";
            }
            else{
                $successfull = false;
            }
        }


        
        

    }

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
    <?php
    if($successfull){
        echo "
            <section class='p-[3vw] w-[100vw]  bg-green-500 absolute top-0 shadow-xl'>
            <p class='  absolute top-5 right-5' onclick='removeMsg()'>
            x
        </p>
    
                <p class='flex justify-center items-center'> Question added Successfully</p>
            </section>
        ";
    }
    ?>

<script>
            function removeMsg(){
                <?php
                    $successfull = false;
                ?>
            }
        </script>

    <main class="mt-5 ">
        <section class="flex justify-center items-center ">
        
            <form action="uploadQuestions.php" method="post" class="bg-white shadow-xl rounded-xl p-10">
                <div class="my-2">
                    <select name="type" id="type" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" required>
                        <div class="bg-white p-2">
                            <option value=""  <?php if($type=="") echo "selected";?>> ------- Select a Question Type ----------</option>
                            <option value="mcqs" <?php if($type=="mcqs") echo "selected";?>> MCQS </option>
                            <option value="fib" <?php if($type=="fib") echo "selected";?>> Fill In The Blanks</option>
                            <option value="tf"> <?php if($type=="tf") echo "selected";?>True Or False</option>
                            <option value="atf" <?php if($type=="atf") echo "selected";?>> Answer The Following Question. </option>
                        </div>
                    </select>
                    <?php
                        if($typeErr){
                            echo "<p class='text-red-500 my-3 '> $typeErr </p>";
                        }
                    ?>
                </div>
                <div class="my-2">
                    <textarea name="question" required placeholder="Enter your Question"  class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300 resize-none  shadow-lg h-32 w-[80vw] lg:w-[50vw]" value=""><?php echo htmlspecialchars($question);?></textarea>
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
                        <?php
                        if($optionErr){
                            echo "<p class='text-red-500 my-3 '> $optionErr </p>";
                        }
                    ?>
                </div>
                <div class="my-2">
                    <select name="level" required id="level" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                        <div class="bg-white my-2">
                            <option value=""  <?php if($level=="") echo "selected"; ?>>-------- Select Level of Your Question -----------</option>
                            <option value="easy" <?php if($level=="easy") echo "selected"; ?>>Easy</option>
                            <option value="medium" <?php if($level=="medium") echo "selected"; ?>>Medium</option>
                            <option value="hard" <?php if($level=="hard") echo "selected"; ?>>Hard</option>
                        </div>
                    </select>
                    <?php
                        if($levelErr){
                            echo "<p class='text-red-500 my-3 '> $levelErr </p>";
                        }
                    ?>
                </div>
                <div class="my-2">
                    <input type="number" required name="weightage" value="<?php echo $weightage;?>" class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" placeholder="Weightage ">
                    <?php
                        if($weightageErr){
                            echo "<p class='text-red-500 my-3 '> $weightageErr </p>";
                        }
                    ?>
                </div>
                <div class="my-2">
                    <select name="class" required id="class" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                        <div class="bg-white my-2">
                            <option value=""  <?php if($class=="") echo "selected"; ?>>-------- Select Class -----------</option>
                            <option value="fy"    <?php if($class=="fy") echo "selected"; ?>>FY</option>
                            <option value="sy"   <?php if($class=="sy") echo "selected"; ?>>SY</option>
                            <option value="ty"   <?php if($class=="ty") echo "selected"; ?>>TY</option>
                        </div>
                    </select>
                    <?php
                        if($classErr){
                            echo "<p class='text-red-500 my-3 '> $classErr </p>";
                        }
                    ?>
                </div>
                <div class="my-2">
                    <select name="sub" value="<?php echo $sub;?>" required id="sub" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                        <div class="bg-white my-2">
                            <option value=""   <?php if($sub=="") echo "selected"; ?>>-------- Select Subject -----------</option>
                            <option value="501"  <?php if($sub=="501") echo "selected"; ?> >AWD</option>
                            <option value="502"  <?php if($sub=="502") echo "selected"; ?>>Network Technology</option>
                            <option value="503"  <?php if($sub=="503") echo "selected"; ?>>WFS</option>
                            <option value="504"  <?php if($sub=="504") echo "selected"; ?>>ASP.Net</option>
                            <option value="505"  <?php if($sub=="505") echo "selected"; ?>>Unix</option>
                        </div>
                    </select>
                    <?php
                        if($subErr){
                            echo "<p class='text-red-500 my-3 '> $subErr </p>";
                        }
                    ?>
                </div>
                <input type="submit" name="addhojabhai" value="Add" class="px-5 w-full py-2 bg-white text-red-500 border border-red-500 hover:bg-red-500 hover:text-white rounded-lg shadow-xl">
            </form>
        </section>
    </main>

    <script type="text/javascript">
        $(document).ready(()=>{

                $("#option-div").hide();
            if($("#type").val()=="mcqs"){
                $("#option-div").show();

            }
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
