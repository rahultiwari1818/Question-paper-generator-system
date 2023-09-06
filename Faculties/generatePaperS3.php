<?php
session_start();
include("../Partials/connection.php");


if (!isset($_SESSION["uId"])) {
    header("location: ../login.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"]!="POST"){
    header("location:/QPG/Faculties/generatePaper.php");
}


$totalFib = "";
$optionalFib = "";
$totalMcqs = "";
$optionalMcqs = "";
$totalTf = "";
$optionalTf = "";
$totalAtf1 = "";
$optionalAtf1 = "";
$totalAtf2 = "";
$optionalAtf2 = "";
$totalAtf3 = "";
$optionalAtf3 = "";
$totalAtf4 = "";
$optionalAtf4 = "";
$totalAtf5 = "";
$optionalAtf5 = "";
$totalAtf7 = "";
$optionalAtf7 = "";

$classId = $_SESSION["selectedClass"];
$subjectId = $_SESSION["selectedSubject"];
$userId = $_SESSION["uId"];

// -----------------------------------------------------------------------------------

if (isset($_POST["totalMcqs"])) {
    $totalMcqs = $_POST["totalMcqs"];
    $optionalMcqs = $_POST["optionalMcqs"];
}

if (isset($_POST["totalFib"])) {
    $totalFib = $_POST["totalFib"];
    $optionalFib = $_POST["optionalFib"];
}

if (isset($_POST["totalTf"])) {
    $totalTf = $_POST["totalTf"];
    $optionalTf = $_POST["optionalTf"];
}

if (isset($_POST["totalAtf1"])) {
    $totalAtf1 = $_POST["totalAtf1"];
    $optionalAtf1 = $_POST["optionalAtf1"];
}

if (isset($_POST["totalAtf2"])) {
    $totalAtf2 = $_POST["totalAtf2"];
    $optionalAtf2 = $_POST["optionalAtf2"];
}

if (isset($_POST["totalAtf3"])) {
    $totalAtf3 = $_POST["totalAtf3"];
    $optionalAtf3 = $_POST["optionalAtf3"];
}

if (isset($_POST["totalAtf4"])) {
    $totalAtf4 = $_POST["totalAtf4"];
    $optionalAtf4 = $_POST["optionalAtf4"];
}

if (isset($_POST["totalAtf5"])) {
    $totalAtf5 = $_POST["totalAtf5"];
    $optionalAtf5 = $_POST["optionalAtf5"];
}

if (isset($_POST["totalAtf7"])) {
    $totalAtf7 = $_POST["totalAtf7"];
    $optionalAtf7 = $_POST["optionalAtf7"];
}

// -----------------------------------------------------------------------------------



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
        <section class="flex justify-center items-center">
            <h2
                class="px-10 md:w-1/2 py-3 text-blue-500 lg:text-2xl text-lg bg-white text-center rounded-lg shadow-lg my-5 ">
                Generated Paper</h2>
        </section>

        <section class="flex justify-center items-center">
            <section class="  p-5 bg-white rounded-lg shadow-lg" id="paperContent">
                <section class="border border-2 p-3">
                    <section>
                        <p class="text-center text-2xl font-semibold">
                            <?php echo $_SESSION["instituteName"]; ?>
                        </p>
                    </section>
                    <section>
                        <section class="flex justify-between items-center gap-10">
                            <p class="text-lg  my-4 ">
                                <span class="font-semibold"> Class : <span>
                                        <?php
                                        $cid = $_SESSION["selectedClass"];
                                        $sql = "select *  from tbl_class where cId = $cid";
                                        $result = mysqli_query($conn, $sql);
                                        $row = $result->fetch_assoc();
                                        $class = $row["class"];
                                        echo $class;
                                        ?>
                            </p>
                            <p class="text-lg   my-4 ">
                                <span class="font-semibold"> Subject : <span>

                                        <?php
                                        $sid = $_SESSION["selectedSubject"];
                                        $sql = "select *  from tbl_subjects where sId = $sid";
                                        $result = mysqli_query($conn, $sql);
                                        $row = $result->fetch_assoc();
                                        $subject = $row["subject"];
                                        echo $subject;
                                        ?>
                            </p>
                        </section>
                        <section class="flex justify-between items-center gap-10">
                            <p class="text-lg my-4">
                                <span class="font-semibold"> Total Marks : <span>
                                        <input type="number" value="<?php echo $_SESSION['totalMarks']; ?>" name=""
                                            id="totalSetMarks" class="bg-transparent" disabled>

                            </p>
                            <p class="text-lg my-4">
                                <span class="font-semibold"> Total Time : <span>
                                        <?php echo $_SESSION["totalTime"]; ?>
                                        <span class="font-semibold"> Minutes. <span>

                            </p>
                        </section>
                    </section>
                </section>
                <section class="border border-2 p-3">

                    <?php
                        if ($totalMcqs) {
                            $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'mcqs'  ORDER BY RAND() limit $totalMcqs";
                            $result = $conn->query($sql);
                            // echo $result->num_rows;
                            // echo " ".$totalMcqs; 
                            $selectedQuestions = [];
                    ?>
                        <section class="my-4 px-5">
                            <section class="flex justify-between items-center">
                                <p class="font-semibold -ml-2">Multiple Choice Questions. &nbsp; &nbsp; &nbsp; (Any <?php echo $totalMcqs-$optionalMcqs; ?> )</p>
                                <p class="font-semibold">(<?php echo $totalMcqs; ?>)</p>
                            </section>
                    <?php
                            $srno = 1;
                            while ($row = $result->fetch_assoc()) {
                    ?>
                            <section class="my-2">
                                <section class="flex justify-start gap-3">
                                    <p><?echo $srno;?>.</p>
                                    <p><?echo $row["question"];?></p>
                                </section>
                                <section>
                                    <p><span class="px-3">A.</span><?echo $row["option1"];?></p>
                                    <p><span class="px-3">B.</span><?echo $row["option2"];?></p>
                                    <p><span class="px-3">C.</span><?echo $row["option3"];?></p>
                                    <p><span class="px-3">D.</span><?echo $row["option4"];?></p>
                                </section>
                            </section>
                    <?php
                            $srno+=1;
                        }

                    ?>
                        </section>  
                    <?php

                        }
                    ?>



                    <?php
                        if ($totalFib) {
                            $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'fib'  ORDER BY RAND() limit $totalFib";
                            $result = $conn->query($sql);
                            $selectedQuestions = [];
                    ?>
                        <section class="my-4 px-5">
                            <section class="flex justify-between items-center">
                                <p class="font-semibold -ml-2">Fill In the Blanks. &nbsp; &nbsp; &nbsp; (Any <?php echo $totalFib-$optionalFib; ?> )</p>
                                <p class="font-semibold">(<?php echo $totalFib; ?>)</p>
                            </section>
                    <?php
                            $srno = 1;
                            while ($row = $result->fetch_assoc()) {
                    ?>
                            <section class="my-2">
                                <section class="flex justify-start gap-3">
                                    <p><?echo $srno;?>.</p>
                                    <p><?echo $row["question"];?></p>
                                </section>

                            </section>
                    <?php
                            $srno+=1;
                        }

                    ?>
                        </section>  
                    <?php

                        }
                    ?>



                    
                    
                    <?php
                        if ($totalTf) {
                            $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'tf'  ORDER BY RAND() limit $totalTf";
                            $result = $conn->query($sql);
                            $selectedQuestions = [];
                    ?>
                        <section class="my-4 px-5">
                            <section class="flex justify-between items-center">
                                <p class="font-semibold -ml-2">True or False. &nbsp; &nbsp; &nbsp; (Any <?php echo $totalTf-$optionalTf; ?> )</p>
                                <p class="font-semibold">(<?php echo $totalTf; ?>)</p>
                            </section>
                    <?php
                            $srno = 1;
                            while ($row = $result->fetch_assoc()) {
                    ?>
                            <section class="my-2">
                                <section class="flex justify-start gap-3">
                                    <p><?echo $srno;?>.</p>
                                    <p><?echo $row["question"];?></p>
                                </section>

                            </section>
                    <?php
                            $srno+=1;
                        }

                    ?>
                        </section>  
                    <?php

                        }
                    ?>

                    <?php
                        if ($totalAtf1) {
                            $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'atf'  ORDER BY RAND() limit $totalAtf1";
                            $result = $conn->query($sql);
                            $selectedQuestions = [];
                    ?>
                        <section class="my-4 px-5">
                            <section class="flex justify-between items-center">
                                <p class="font-semibold -ml-2">Answer The Following Questions - 1 Mark Each. &nbsp; &nbsp; &nbsp; (Any <?php echo $totalAtf1-$optionalAtf1; ?> )</p>
                                <p class="font-semibold">(<?php echo $totalAtf1; ?>)</p>
                            </section>
                    <?php
                            $srno = 1;
                            while ($row = $result->fetch_assoc()) {
                    ?>
                            <section class="my-2">
                                <section class="flex justify-start gap-3">
                                    <p><?echo $srno;?>.</p>
                                    <p><?echo $row["question"];?></p>
                                </section>

                            </section>
                    <?php
                            $srno+=1;
                        }

                    ?>
                        </section>  
                    <?php

                        }
                    ?>



                    <?php
                        if ($totalAtf2) {
                            $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'atf'  ORDER BY RAND() limit $totalAtf2";
                            $result = $conn->query($sql);
                            $selectedQuestions = [];
                    ?>
                        <section class="my-4 px-5">
                            <section class="flex justify-between items-center">
                                <p class="font-semibold -ml-2">Answer The Following Questions - 2 Marks Each. &nbsp; &nbsp; &nbsp; (Any <?php echo $totalAtf2-$optionalAtf2; ?> )</p>
                                <p class="font-semibold">(<?php echo (($totalAtf2-$optionalAtf2)*2); ?>)</p>
                            </section>
                    <?php
                            $srno = 1;
                            while ($row = $result->fetch_assoc()) {
                    ?>
                            <section class="my-2">
                                <section class="flex justify-start gap-3">
                                    <p><?echo $srno;?>.</p>
                                    <p><?echo $row["question"];?></p>
                                </section>

                            </section>
                    <?php
                            $srno+=1;
                        }

                    ?>
                        </section>  
                    <?php

                        }
                    ?>


                    <?php
                        if ($totalAtf3) {
                            $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'atf'  ORDER BY RAND() limit $totalAtf3";
                            $result = $conn->query($sql);
                            $selectedQuestions = [];
                    ?>
                        <section class="my-4 px-5">
                            <section class="flex justify-between items-center">
                                <p class="font-semibold -ml-2">Answer The Following Questions - 3 Marks Each. &nbsp; &nbsp; &nbsp; (Any <?php echo $totalAtf3-$optionalAtf3; ?> )</p>
                                <p class="font-semibold">(<?php echo (($totalAtf3-$optionalAtf3)*3); ?>)</p>
                            </section>
                    <?php
                            $srno = 1;
                            while ($row = $result->fetch_assoc()) {
                    ?>
                            <section class="my-2">
                                <section class="flex justify-start gap-3">
                                    <p><?echo $srno;?>.</p>
                                    <p><?echo $row["question"];?></p>
                                </section>

                            </section>
                    <?php
                            $srno+=1;
                        }

                    ?>
                        </section>  
                    <?php

                        }
                    ?>




                    <?php
                        if ($totalAtf4) {
                            $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'atf'  ORDER BY RAND() limit $totalAtf4";
                            $result = $conn->query($sql);
                            $selectedQuestions = [];
                    ?>
                        <section class="my-4 px-5">
                            <section class="flex justify-between items-center">
                                <p class="font-semibold -ml-2">Answer The Following Questions - 4 Marks Each. &nbsp; &nbsp; &nbsp; (Any <?php echo $totalAtf4-$optionalAtf4; ?> )</p>
                                <p class="font-semibold">(<?php echo (($totalAtf4-$optionalAtf4)*4); ?>)</p>
                            </section>
                    <?php
                            $srno = 1;
                            while ($row = $result->fetch_assoc()) {
                    ?>
                            <section class="my-2">
                                <section class="flex justify-start gap-3">
                                    <p><?echo $srno;?>.</p>
                                    <p><?echo $row["question"];?></p>
                                </section>

                            </section>
                    <?php
                            $srno+=1;
                        }

                    ?>
                        </section>  
                    <?php

                        }
                    ?>





                    <?php
                        if ($totalAtf5) {
                            $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'atf'  ORDER BY RAND() limit $totalAtf5";
                            $result = $conn->query($sql);
                            $selectedQuestions = [];
                    ?>
                        <section class="my-4 px-5">
                            <section class="flex justify-between items-center">
                                <p class="font-semibold -ml-2">Answer The Following Questions - 5 Marks Each. &nbsp; &nbsp; &nbsp; (Any <?php echo $totalAtf5-$optionalAtf5; ?> )</p>
                                <p class="font-semibold">(<?php echo (($totalAtf5-$optionalAtf5)*5); ?>)</p>
                            </section>
                    <?php
                            $srno = 1;
                            while ($row = $result->fetch_assoc()) {
                    ?>
                            <section class="my-2">
                                <section class="flex justify-start gap-3">
                                    <p><?echo $srno;?>.</p>
                                    <p><?echo $row["question"];?></p>
                                </section>

                            </section>
                    <?php
                            $srno+=1;
                        }

                    ?>
                        </section>  
                    <?php

                        }
                    ?>




                    <?php
                        if ($totalAtf7) {
                            $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'atf'  ORDER BY RAND() limit $totalAtf7";
                            $result = $conn->query($sql);
                            $selectedQuestions = [];
                    ?>
                        <section class="my-4 px-5">
                            <section class="flex justify-between items-center">
                                <p class="font-semibold -ml-2">Answer The Following Questions - 7 Marks Each. &nbsp; &nbsp; &nbsp; (Any <?php echo $totalAtf7-$optionalAtf7; ?> )</p>
                                <p class="font-semibold">(<?php echo (($totalAtf7-$optionalAtf7)*7); ?>)</p>
                            </section>
                    <?php
                            $srno = 1;
                            while ($row = $result->fetch_assoc()) {
                    ?>
                            <section class="my-2">
                                <section class="flex justify-start gap-3">
                                    <p><?echo $srno;?>.</p>
                                    <p><?echo $row["question"];?></p>
                                </section>

                            </section>
                    <?php
                            $srno+=1;
                        }

                    ?>
                        </section>  
                    <?php

                        }
                    ?>






                </section>
            </section>
        </section>

    </main>



    <footer class="bg-white bottom-0  p-[1vh] fixed w-screen  ">
        <section class="flex justify-center items-center">
            <p class="font-serif antialiased font-black lg:text-xl text-base	"></p>
            Developed With <img src="../Assets/Icons/HeartIcon.svg" class="h-5 w-5 mx-2" alt="Heart Icon">
            By Team LinkedList
        </section>
    </footer>

</body>

</html>