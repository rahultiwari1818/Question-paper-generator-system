<?php
    session_start();
    include("../Partials/connection.php");


    if(!isset($_SESSION["uId"])){
        header("location: ../login.php");
        exit();
    }

    $selectedClass = "";
    $selectedSubject = "";
    $totalMarks = "";
    $totalTime = "";
    $selectedClassErr = "";
    $selectedSubjectErr = "";
    $totalMarksErr = "";
    $totalTimeErr = "";


    if(isset($_POST["lockhojabhai"]) && ($_POST["lockhojabhai"])=="Lock and Proceed"){
        $selectedClass = $_POST["selectedClass"];
        $selectedSubject = $_POST["selectedSubject"];
        $totalMarks = $_POST["totalMarks"];
        $totalTime = $_POST["totalTime"];

        $valid = true;

        $selectedClass = trim($selectedClass);
        $selectedSubject = trim($selectedSubject);
        $totalMarks = trim($totalMarks);
        $totalTime = trim($totalTime);

        if(empty($selectedClass)){
            $selectedClassErr = "Class Can Not Be Empty. !";
            $valid = false;
        }

        if(empty($selectedSubject)){
            $selectedSubjectErr = "Subject Can Not Be Empty. !";
            $valid = false;
        }

        if(empty($totalMarks)){
            $totalMarksErr = "Total Marks Can Not Be Empty. !";
            $valid = false;
        }

        if(empty($selectedClass)){
            $selectedClassErr = "Class Can Not Be Empty. !";
            $valid = false;
        }

        if($valid){
            $_SESSION["selectedClass"] = $selectedClass;
            $_SESSION["selectedSubject"] = $selectedSubject;
            $_SESSION["totalMarks"] = $totalMarks;
            $_SESSION["totalTime"] = $totalTime;

            header("location:./generatePaperS2.php");
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Paper</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../script/jquery-3.6.3.js"></script>
    <script src="../script/script.js"></script>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

    <?php
        include("../Partials/navbar.php");
    ?>
    
    <main>

        <section class="flex justify-center items-center my-5">
            <section class="p-5 rounded-xl shadow-xl bg-white text-blue-500">

                <p class="text-2xl bg-blue-500 text-white p-3 rounded-xl shadow-xl text-center">
                    Step 1
                </p>
                <form action="#" method="post">
                    <section class="my-3">
                        <select name="selectedClass" value="<?php echo $selectedClass; ?>"   id="selectedClass" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" required>
                            <div class="bg-white my-2">

                            </div>
                        </select>
                        <p class='text-red-500 my-3 '>  </p>
                    </section>
                    <section  class="my-3">
                        <select name="selectedSubject"  value="<?php echo $selectedSubject; ?>"   id="selectedSubject" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"  required>
                            <div class="bg-white my-2">
                                <option value=''>---- Select a Subject ----</option>
                            </div>
                        </select>
                        <p class='text-red-500 my-3 '>  </p>
                    </section>
                    <section class="my-3">
                        <input type="number"  value="<?php echo $totalMarks; ?>"  name="totalMarks" id="totalMarks"  class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" placeholder="Total Marks " required>
                        <p class='text-red-500 my-3 '>  </p>
                    </section>
                    <section class="my-3">
                        <input type="number"  value="<?php echo $totalTime; ?>"  name="totalTime" id="totalTime"  class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" placeholder="Total Time in Minutes " required>
                        <p class='text-red-500 my-3 '>  </p>
                    </section>
                    <section  class="my-3">
                        <input type="submit" value="Lock and Proceed" name="lockhojabhai" class="px-5 w-full py-2 bg-white text-red-500 border border-red-500 hover:bg-red-500 hover:text-white rounded-lg shadow-xl">
                    </section>
                </form>


            </section>
        </section>

    </main>


<!--------------------------------------------------------- PreLoader ---------------------------------------------------- -->



         <div id="preLoader" class="absolute h-[100vh] z-50 w-[100vw] top-0 bg-white"></div>

<!--------------------------------------------------------- ------------------------------- ---------------------------------------------------- -->
 

    <script type="text/javascript">
        $(document).ready(()=>{
            fetchClassesInSubject("selectedClass");
            $("#selectedSubject").attr("disabled",true);
            $("#preLoader").hide();

            $("#selectedClass").change(function(){
                if($(this).val()==""){
                    $("#selectedSubject").html("<option value=''>---- Select a Subject ----</option>")
                    $("#selectedSubject").attr("disabled",true);
                    return;
                }
                $("#selectedSubject").attr("disabled",false);
                fetchSubjectsForView("selectedSubject",$(this).val());
            })


            $("#selectedSubject").change(function(){
                if($(this).val()==""){
                    return;
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