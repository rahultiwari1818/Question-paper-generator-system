<?php
    session_start();
    include("../Partials/connection.php");


    if(!isset($_SESSION["uId"])){
        header("location:../login.php");
        exit();
    }




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
        $uid = $_SESSION["uId"];


        if(!$err){
            $question = addslashes($question);
            $options = addslashes($options);
            $currentDate = date("Y-m-d");
            $sql = "insert into tbl_questions values(NULL,'$question','$type','$options','$level',$weightage,$class,$sub,$uid,'$currentDate')";
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
    <script src="../script/script.js"></script>
    <script src="../script/jquery-3.6.3.js"></script>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <?
        include("../Partials/navbar.php");
    ?>
    <?php
    if($successfull){
        echo "
        <section class='p-[1vw] w-[100vw]  bg-green-500 absolute top-0 shadow-xl' id='successMessage'>
        <p class='  absolute lg:top-5 md:top-4 top-3  right-5 cursor-pointer' onclick='removeMsg()'>
            <img src='../Assets/Icons/close.svg' alt='Close Icon'/>
         </p>
    
                <p class='flex justify-center items-center'> Question added Successfully</p>
            </section>
        ";
    }
    ?>


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
                    <select name="class" required id="classUPQ" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                        <div class="bg-white my-2">
                             <option value=""   <?php if($class=="") echo "selected"; ?>>-------- Select Class ----------- </option>
                        </div>
                    </select>
                    <?php
                        if($classErr){
                            echo "<p class='text-red-500 my-3 '> $classErr </p>";
                        }
                    ?>
                </div>
                <div class="my-2">
                    <select name="sub" value="<?php echo $sub;?>" required id="subUPQ" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                        <div class="bg-white my-2">
                            <option value=""   <?php if($sub=="") echo "selected"; ?>>-------- Select Subject -----------</option>
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

    <!-- Script to Prevent Form Submission during Page Reload -->

    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>

    <script type="text/javascript">
        // to add preloader
        $("body").append('<div id="preLoader" class="absolute h-[100vh] w-[100vw] top-0 bg-white"></div>');




                        
        $(document).ready(()=>{

            // To remove Preloader
             $("#preLoader").remove();
            // To options initially
             $("#option-div").hide();
            //  to disable subjects initially
            $("#subUPQ").attr("disabled",true);

            $("#classUPQ").change(()=>{
                $("#subUPQ").attr("disabled",false);
                fetchSubjectsClassWise();

            })
            //  to show options when errors are there after submitting
            if($("#type").val()=="mcqs"){
                $("#option-div").show();

            }
            // To Show Options When user select Mcqs
            $("#type").change(()=>{
                if($("#type").val() == "mcqs"){
                    $("#option-div").show();
                }
                else{
                    $("#option-div").hide();
                }
            })

            fetchClassesInUploadQuestion();

             // Set Time Out to remove message Automatically after 3 seconds
            setTimeout(()=>{
                removeMsg();
            },3000)






        })
    </script>
</body>
</html>
