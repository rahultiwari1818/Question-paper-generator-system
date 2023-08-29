<?php 

    session_start();
    include("../Partials/connection.php");


    if(!isset($_SESSION["uId"])){
        header("location: ../login.php");
        exit();
    }
    $qid = "";
    try {
        if(isset($_GET["question"])){

            $qid =  $_GET["question"];
        }
        
    } catch (\Throwable $th) {
        //throw $th;
    }

    $question = "" ;
    $type="";
    $level = "";
    $class = "";
    $sub = "";
    $weightage = "";
    $chapter="";
    $option1 = "";
    $option2 = "";
    $option3 = "";
    $option4 = "";
    $options = "";  
    $questionErr="";
    $typeErr = "";
    $levelErr = "";
    $classErr = "";
    $chapterErr="";
    $subErr = "";
    $weightageErr = "";
    $optionErr = "";
    $successfull = false;


    if(isset($_POST["addhojabhai"]) && ($_POST["addhojabhai"])=="Update"){
        try {
            //code...

            $question = $_POST["question"] ;
            $type = $_POST["type"];
            $level = $_POST["level"];
            $class = $_POST["class"];
            $sub = $_POST["sub"];
            $weightage = $_POST["weightage"];
            $chapter = $_POST["chapter"];

            $err = false;
        } catch (\Throwable $th) {
            //throw $th;
        }

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
        if(trim($chapter) == ""){
            $chapterErr = "Please Enter Chapter to Which Chapter Belongs *";
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
            // echo "$qid id hai bhai";
            $sql = "update tbl_questions set question='$question', q_type='$type',option1='$option1',option2='$option2',option3='$option3',option4='$option4',level='$level',weightage=$weightage,chapter=$chapter,classId=$class,subId=$sub where qId=$qid";
            // $sql = "insert into tbl_questions values(NULL,'$question','$type','$option1','$option2','$option3','$option4','$level',$weightage,$chapter,$class,$sub,$uid,'$currentDate')";
            if($conn->query($sql) === TRUE){
                // echo "inside main block";

                $successfull = true;
                $question = "" ;
                $type="";
                $level = "";
                $class = "";
                $sub = "";
                $weightage = "";
                $chapter="";
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
                $chapterErr="";
                // echo "successfully updated";
                header("location: viewQuestions.php?success=true");
            }
            else{
                $successfull = false;
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Questions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../script/script.js"></script>
    <script src="../script/jquery-3.6.3.js"></script>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

    <?php
                    include("../Partials/navbar.php");
    ?>

<main class="my-5 ">
        <section class="flex justify-center items-center ">
            <section>
                <h2 class="text-center text-white text-xl my-3">Update Question</h2>

            <form  method="post" class="bg-white shadow-xl rounded-xl p-10" id="updateForm">
                <div class="my-2">
                    <select name="type" id="updateType" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" required>
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
                    <textarea name="question" id="updateQuestion" required placeholder="Enter your Question"  class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300 resize-none  shadow-lg h-32 w-[80vw] lg:w-[50vw]" value=""><?php echo htmlspecialchars($question);?></textarea>
                    <?php
                        if($questionErr){
                            echo "<p class='text-red-500 my-3 '> $questionErr </p>";
                        }
                    ?>
                </div>
                <div class="my-2" id="option-div">
                        <input type="text" name="opt1" id="updateOption1"   value="<?php echo $option1 ?>"  placeholder="Option1" class="block shadow-xl  my-1  appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"> 
                      
                        <input type="text" name="opt2" id="updateOption2" value="<?php echo $option2 ?>" placeholder="Option2" class="block shadow-xl my-1  appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                      
                        <input type="text" name="opt3" id="updateOption3" value="<?php echo $option4 ?>" placeholder="Option3" class="block shadow-xl my-1  appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                      
                        <input type="text" name="opt4"id="updateOption4"  value="<?php echo $option4 ?>" placeholder="Option4" class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                        <?php
                        if($optionErr){
                            echo "<p class='text-red-500 my-3 '> $optionErr </p>";
                        }
                    ?>
                </div>
                <div class="my-2">
                    <select name="level" required id="updateLevel" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
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
                    <select name="weightage" id="updateWeightage" class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" >
                         <option value=""  >-------- Select Weightage of Your Question -----------</option>
                    </select>
                    <!-- <input type="number" id="" required name="weightage" value="" class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" placeholder="Weightage "> -->
                    <?php
                        if($weightageErr){
                            echo "<p class='text-red-500 my-3 '> $weightageErr </p>";
                        }
                    ?>
                </div>
                <div class="my-2">
                    <input type="number" id="updateChapter" required name="chapter" value="<?php echo $chapter;?>" class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" placeholder="Chapter ">
                    <?php
                        if($chapterErr){
                            echo "<p class='text-red-500 my-3 '> $chapterErr </p>";
                        }
                    ?>
                </div>
                <div class="my-2">
                    <select name="class" required id="updateClassUPQ" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
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
                    <select name="sub" value="<?php echo $sub;?>" required id="updateSubUPQ" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
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
                <input type="submit" name="addhojabhai" value="Update" class="px-5 w-full py-2 bg-white text-red-500 border border-red-500 hover:bg-red-500 hover:text-white rounded-lg shadow-xl">
            </form>
            <button  class="px-5 w-full py-2 bg-white text-blue-500 my-2 border border-blue-500 hover:bg-blue-500 hover:text-white rounded-lg shadow-xl" id="cancelBtn">Cancel Update</button>
            </section>
        
        </section>
    </main>


    <!--------------------------------------------------------- PreLoader ---------------------------------------------------- -->

             <div id="preLoader" class="absolute h-[100vh] z-50 w-[100vw] top-0 bg-white"></div>

        <!--------------------------------------------------------- ------------------------------- ---------------------------------------------------- -->

        
    <!-- Script to Prevent Form Submission during Page Reload -->

    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>


<script type="text/javascript">
        




                        
        $(document).ready(()=>{


            fetchClassesInUploadQuestion();

            // To options initially
            $("#option-div").hide();
            //  to disable subjects initially
            $("#subUPQ").attr("disabled",true);

            const queryParams = new URLSearchParams(window.location.search);
            try {
                const id = queryParams.get("question");
                if(id){

                    getQuestionData(id);
                    $("#updateForm").attr("action",`updateQuestion.php?question=${id}`);
                }
                else{
                    $("#updateForm").attr("action",`updateQuestion.php?question=`);
                }
            } catch (error) {
                
            }
            
            $("#cancelBtn").click(()=>{
                // console.log("clicked")
                window.location.href="http://localhost/qpg/Faculties/viewQuestions.php";
            })
            

            // To remove Preloader
             $("#preLoader").hide();

             setTimeout(()=>{

                let selectedValue = $("#updateType").val();

                if(["mcqs","fib","tf"].includes(selectedValue)){
                    let options = `
                        <option value = "" disabled>-------- Select Weightage of Your Question -----------</option>
                         <option value="1" >1</option>
                    `;
                    $("#updateWeightage").html(options);

                }
                else{
                    let options = `
                        <option value = "" disabled>-------- Select Weightage of Your Question -----------</option>
                         <option value="1" >1</option>
                         <option value="2" >2</option>
                         <option value="3" >3</option>
                         <option value="4" >4</option>
                         <option value="5" >5</option>
                         <option value="7" >7</option>
                    `;
                    $("#updateWeightage").html(options);

                }
             },700)



            $("#updateClassUPQ").change(()=>{
                $("#updateSubUPQ").attr("disabled",false);
                let _class = $("#updateClassUPQ").val();
                fetchSubjectsClassWise(_class);

            })
            //  to show options when errors are there after submitting
            if($("#updateType").val()=="mcqs"){
                $("#option-div").show();

            }
            let count = 0;
            // To Show Options When user select Mcqs
            $("#updateType").change(()=>{
                if($("#updateType").val() == "mcqs"){
                    $("#option-div").show();
                }
                else{
                    $("#option-div").hide();
                }


                let selectedValue = $("#updateType").val();

                if(["mcqs","fib","tf"].includes(selectedValue)){
                    let options = `
                        <option value = "" disabled>-------- Select Weightage of Your Question -----------</option>
                         <option value="1" >1</option>
                    `;
                    $("#updateWeightage").html(options);

                }
                else{
                    let options = `
                        <option value = "" disabled>-------- Select Weightage of Your Question -----------</option>
                         <option value="1" >1</option>
                         <option value="2" >2</option>
                         <option value="3" >3</option>
                         <option value="4" >4</option>
                         <option value="5" >5</option>
                         <option value="7" >7</option>
                    `;
                    $("#updateWeightage").html(options);

                }
            })










        })
    </script>

        <footer class="bg-white bottom-0  p-[1vh] fixed w-screen  ">
            <section class="flex justify-center items-center">
                <p class="font-serif antialiased font-black lg:text-xl text-base	"></p>
                Developed With <img src="../Assets/Icons/HeartIcon.svg" class="h-5 w-5 mx-2" alt="Heart Icon">
                 By Team LinkedList
            </section>
        </footer>


</body>
</html>