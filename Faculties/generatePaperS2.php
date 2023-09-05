<?php
session_start();
include("../Partials/connection.php");


if (!isset($_SESSION["uId"])) {
    header("location: ../login.php");
    exit();
}

if ((!isset($_SESSION["selectedClass"])) || (!isset($_SESSION["selectedSubject"])) || (!isset($_SESSION["totalMarks"])) || (!isset($_SESSION["totalTime"]))) {
    header("./generatePaper.php");
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
                <section class="p-5 rounded-xl shadow-xl bg-white text-blue-500 ">
                    <section>
                        <p class="text-2xl bg-blue-500 text-white p-3 rounded-xl shadow-xl text-center">
                            Step 2
                        </p>
                        <section class="block md:flex justify-between items-center gap-5 my-5">
                            <p class="text-lg bg-blue-500 text-white p-2 my-2 rounded-xl shadow-xl text-center">
                                Class :
                                <?php
                                    $cid = $_SESSION["selectedClass"];
                                    $sql = "select *  from tbl_class where cId = $cid";
                                    $result = mysqli_query($conn, $sql);
                                    $row = $result->fetch_assoc();
                                    $class = $row["class"];
                                    echo $class;
                                ?>
                            </p>
                            <p class="text-lg bg-blue-500 text-white p-2 my-2 rounded-xl shadow-xl text-center">
                                Subject :
                                <?php
                                    $sid = $_SESSION["selectedSubject"];
                                    $sql = "select *  from tbl_subjects where sId = $sid";
                                    $result = mysqli_query($conn, $sql);
                                    $row = $result->fetch_assoc();
                                    $subject = $row["subject"];
                                    echo $subject;
                                ?>
                            </p>
                            <p class="text-lg bg-blue-500 text-white p-2 my-2 rounded-xl shadow-xl text-center">
                                Total Marks :
                                <input type="number" value="<?php echo $_SESSION['totalMarks']; ?>" name=""
                                    id="totalSetMarks" class="bg-transparent" disabled>

                            </p>
                            <p class="text-lg bg-blue-500 text-white p-2 my-2 rounded-xl shadow-xl text-center">
                                Total Time :
                                <?php echo $_SESSION["totalTime"]; ?>
                            </p>
                        </section>
                        <section class="my-3">
                            <p class="text-lg bg-blue-500 text-white p-2 my-2 rounded-xl shadow-xl text-center">
                                Enter Your Paper Style
                            </p>
                        </section>
                    </section>
                </section>
            </section>
            <section class="flex justify-center items-center my-5">

                <?php
                    $uid = $_SESSION["uId"];

                    // To count no of MCQS in Db
                    $sql = "select count(*) as count from tbl_questions where uId = $uid and q_type='mcqs'";
                    $result = mysqli_query($conn, $sql);
                    $row = $result->fetch_assoc();
                    $mcqsInDb = $row["count"];



                    // To count no of FIB in Db
                    $sql = "select count(*) as count from tbl_questions where uId = $uid and q_type='fib'";
                    $result = mysqli_query($conn, $sql);
                    $row = $result->fetch_assoc();
                    $fibInDb = $row["count"];


                    // To count no of TF in Db
                    $sql = "select count(*) as count from tbl_questions where uId = $uid and q_type='tf'";
                    $result = mysqli_query($conn, $sql);
                    $row = $result->fetch_assoc();
                    $tfInDb = $row["count"];


                    // To count no of ATF1 in Db
                    $sql = "select count(*) as count from tbl_questions where uId = $uid and q_type='atf' and weightage=1";
                    $result = mysqli_query($conn, $sql);
                    $row = $result->fetch_assoc();
                    $atf1InDb = $row["count"];


                    // To count no of ATF2 in Db
                    $sql = "select count(*) as count from tbl_questions where uId = $uid  and q_type='atf' and weightage=2";
                    $result = mysqli_query($conn, $sql);
                    $row = $result->fetch_assoc();
                    $atf2InDb = $row["count"];


                    // To count no of atf3 in Db
                    $sql = "select count(*) as count from tbl_questions where uId = $uid  and q_type='atf' and weightage=3";
                    $result = mysqli_query($conn, $sql);
                    $row = $result->fetch_assoc();
                    $atf3InDb = $row["count"];


                    // To count no of atf4 in Db
                    $sql = "select count(*) as count from tbl_questions where uId = $uid  and q_type='atf' and weightage=4";
                    $result = mysqli_query($conn, $sql);
                    $row = $result->fetch_assoc();
                    $atf4InDb = $row["count"];


                    // To count no of atf5 in Db
                    $sql = "select count(*) as count from tbl_questions where uId = $uid and  q_type='atf' and weightage=5";
                    $result = mysqli_query($conn, $sql);
                    $row = $result->fetch_assoc();
                    $atf5InDb = $row["count"];

                    // To count no of atf7 in Db
                    $sql = "select count(*) as count from tbl_questions where uId = $uid and  q_type='atf' and weightage=7";
                    $result = mysqli_query($conn, $sql);
                    $row = $result->fetch_assoc();
                    $atf7InDb = $row["count"];



                ?>

                <section class="p-5 rounded-xl shadow-xl bg-white text-blue-500 overflow-scroll">
                    <form action="generatePaperS3.php" method="post">
                        <table class="p-5  text-black rounded-xl border ">
                            <thead class="text-white top-0 sticky z-10">
                                <tr>
                                    <th class="p-[10px] border bg-blue-500">Sr No</th>
                                    <th class="p-[10px] border bg-blue-500">Question Type</th>
                                    <th class="p-[10px] border bg-blue-500">Weightage</th>
                                    <th class="p-[10px] border bg-blue-500">Total No of Questions</th>
                                    <th class="p-[10px] border bg-blue-500">Optional Questions</th>
                                    <th class="p-[10px] border bg-blue-500">No of Questions in Question Bank</th>
                                </tr>
                            </thead>
                            <tbody class="max-h-[77vh] overflow-y-scroll">
                                <tr>
                                    <td class="p-[10px] border ">
                                        1
                                    </td>
                                    <td class="p-[10px] border ">

                                        <select name="mcqs" id="type"
                                            class="block shadow-xl appearance-none w-fit py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            disabled>
                                            <div class="bg-white p-2">
                                                <option value=""> ------- Select a Question Type ----------</option>
                                                <option value="mcqs" selected> MCQS </option>
                                                <option value="fib"> Fill In The Blanks</option>
                                                <option value="tf">True Or False</option>
                                                <option value="atf"> Answer The Following Question. </option>
                                            </div>
                                        </select>
                                    </td>
                                    <td class="p-[10px] border ">
                                        1 Mark
                                    </td>
                                    <td class="p-[10px] border ">
                                        <input type="number" id="totalMcqs" name="totalMcqs"
                                            class=" block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($mcqsInDb == 0) {
                                                echo "disabled";
                                            }
                                            ?>>
                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" name="optionalMcqs" id="optionalMcqs"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($mcqsInDb == 0) {
                                                echo "disabled";
                                            }
                                            ?>>

                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" value="<?php echo $mcqsInDb; ?>" disabled id="mcqsInDb"
                                            name="mcqsInDb"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">

                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-[10px] border ">

                                        2
                                    </td>
                                    <td class="p-[10px] border ">

                                        <select name="type" id="type"
                                            class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            disabled>
                                            <div class="bg-white p-2">
                                                <option value=""> ------- Select a Question Type ----------</option>
                                                <option value="mcqs"> MCQS </option>
                                                <option value="fib" selected> Fill In The Blanks</option>
                                                <option value="tf">True Or False</option>
                                                <option value="atf"> Answer The Following Question. </option>
                                            </div>
                                        </select>
                                    </td>

                                    <td class="p-[10px] border ">
                                        1 Mark
                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" name="totalFib" id="totalFib"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($fibInDb == 0) {
                                                echo "disabled";
                                            }
                                            ?>>

                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" name="optionalFib" id="optionalFib"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($fibInDb == 0) {
                                                echo "disabled";
                                            }
                                            ?>>

                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" value="<?php echo $fibInDb; ?>" disabled id="fibInDb"
                                            name="fibInDb"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">

                                    </td>
                                </tr>
                                <tr>

                                    <td class="p-[10px] border ">

                                        3
                                    </td>
                                    <td class="p-[10px] border ">

                                        <select name="type" id="type"
                                            class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            disabled>
                                            <div class="bg-white p-2">
                                                <option value=""> ------- Select a Question Type ----------</option>
                                                <option value="mcqs"> MCQS </option>
                                                <option value="fib"> Fill In The Blanks</option>
                                                <option value="tf" selected>True Or False</option>
                                                <option value="atf"> Answer The Following Question. </option>
                                            </div>
                                        </select>
                                    </td>

                                    <td class="p-[10px] border ">
                                        1 Mark
                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" name="totalTf" id="totalTf"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($tfInDb == 0) {
                                                echo "disabled";
                                            }
                                            ?>>

                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" name="optionalTf" id="optionalTf"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($tfInDb == 0) {
                                                echo "disabled";
                                            }
                                            ?>>

                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" value="<?php echo $tfInDb; ?>" disabled id="tfInDb"
                                            name="tfInDb"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">

                                    </td>
                                </tr>
                                <tr>

                                    <td class="p-[10px] border ">

                                        4
                                    </td>
                                    <td class="p-[10px] border ">

                                        <select name="type" id="type"
                                            class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            disabled>
                                            <div class="bg-white p-2">
                                                <option value=""> ------- Select a Question Type ----------</option>
                                                <option value="mcqs"> MCQS </option>
                                                <option value="fib"> Fill In The Blanks</option>
                                                <option value="tf">True Or False</option>
                                                <option value="atf" selected> Answer The Following Question. </option>
                                            </div>
                                        </select>
                                    </td>

                                    <td class="p-[10px] border ">
                                        1 Mark
                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" name="totalAtf1" id="totalAtf1"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($atf1InDb == 0) {
                                                echo "disabled";
                                            }
                                            ?>>

                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" name="optionalAtf1" id="optionalAtf1"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($atf2InDb == 0) {
                                                echo "disabled";
                                            }
                                            ?>>

                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" value="<?php echo $atf1InDb; ?>" disabled id="atf1InDb"
                                            name="atf1InDb"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">

                                    </td>
                                </tr>
                                <tr>

                                    <td class="p-[10px] border ">

                                        5
                                    </td>
                                    <td class="p-[10px] border ">

                                        <select name="type" id="type"
                                            class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            disabled>
                                            <div class="bg-white p-2">
                                                <option value=""> ------- Select a Question Type ----------</option>
                                                <option value="mcqs"> MCQS </option>
                                                <option value="fib"> Fill In The Blanks</option>
                                                <option value="tf">True Or False</option>
                                                <option value="atf" selected> Answer The Following Question. </option>
                                            </div>
                                        </select>
                                    </td>

                                    <td class="p-[10px] border ">
                                        2 Marks
                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" name="totalAtf2" id="totalAtf2"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($atf2InDb == 0) {
                                                echo "disabled";
                                            }
                                            ?>>

                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" name="optionalAtf2" id="optionalAtf2"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($atf2InDb == 0) {
                                                echo "disabled";
                                            }
                                            ?>>

                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" value="<?php echo $atf2InDb; ?>" disabled id="atf2InDb"
                                            name="atf2InDb"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">

                                    </td>
                                </tr>
                                <tr>

                                    <td class="p-[10px] border ">

                                        6
                                    </td>
                                    <td class="p-[10px] border ">

                                        <select name="type" id="type"
                                            class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            disabled>
                                            <div class="bg-white p-2">
                                                <option value=""> ------- Select a Question Type ----------</option>
                                                <option value="mcqs"> MCQS </option>
                                                <option value="fib"> Fill In The Blanks</option>
                                                <option value="tf">True Or False</option>
                                                <option value="atf" selected> Answer The Following Question. </option>
                                            </div>
                                        </select>
                                    </td>

                                    <td class="p-[10px] border ">
                                        3 Marks
                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" name="totalAtf3" id="totalAtf3"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($atf3InDb == 0) {
                                                echo "disabled";
                                            }
                                            ?>>

                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" name="optionalAtf3" id="optionalAtf3"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($atf3InDb == 0) {
                                                echo "disabled";
                                            }
                                            ?>>

                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" value="<?php echo $atf3InDb; ?>" disabled id="atf3InDb"
                                            name="atf3InDb"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">

                                    </td>
                                </tr>
                                <tr>

                                    <td class="p-[10px] border ">

                                        7
                                    </td>
                                    <td class="p-[10px] border ">

                                        <select name="type" id="type"
                                            class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            disabled>
                                            <div class="bg-white p-2">
                                                <option value=""> ------- Select a Question Type ----------</option>
                                                <option value="mcqs"> MCQS </option>
                                                <option value="fib"> Fill In The Blanks</option>
                                                <option value="tf">True Or False</option>
                                                <option value="atf" selected> Answer The Following Question. </option>
                                            </div>
                                        </select>
                                    </td>

                                    <td class="p-[10px] border ">
                                        4 Marks
                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" name="totalAtf4" id="totalAtf4"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($atf4InDb == 0) {
                                                echo "disabled";
                                            }
                                            ?>>

                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" name="optionalAtf4" id="optionalAtf4"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($atf4InDb == 0) {
                                                echo "disabled";
                                            }
                                            ?>>

                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" value="<?php echo $atf4InDb; ?>" disabled id="atf4InDb"
                                            name="atf7InDb"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">

                                    </td>
                                </tr>
                                <tr>

                                    <td class="p-[10px] border ">

                                        8
                                    </td>
                                    <td class="p-[10px] border ">

                                        <select name="type" id="type"
                                            class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            disabled>
                                            <div class="bg-white p-2">
                                                <option value=""> ------- Select a Question Type ----------</option>
                                                <option value="mcqs"> MCQS </option>
                                                <option value="fib"> Fill In The Blanks</option>
                                                <option value="tf">True Or False</option>
                                                <option value="atf" selected> Answer The Following Question. </option>
                                            </div>
                                        </select>
                                    </td>

                                    <td class="p-[10px] border ">
                                        5 Marks
                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" name="totalAtf5" id="totalAtf5"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($atf5InDb == 0) {
                                                echo "disabled";
                                            }
                                            ?>>

                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" name="optionalAtf5" id="optionalAtf5"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($atf5InDb == 0) {
                                                echo "disabled";


                                            }
                                            ?>>

                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" value="<?php echo $atf5InDb; ?>" disabled id="atf5InDb"
                                            name="atf5InDb"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">

                                    </td>
                                </tr>
                                <tr>

                                    <td class="p-[10px] border ">

                                        9
                                    </td>
                                    <td class="p-[10px] border ">

                                        <select name="type" id="type"
                                            class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            disabled>
                                            <div class="bg-white p-2">
                                                <option value=""> ------- Select a Question Type ----------</option>
                                                <option value="mcqs"> MCQS </option>
                                                <option value="fib"> Fill In The Blanks</option>
                                                <option value="tf">True Or False</option>
                                                <option value="atf" selected> Answer The Following Question. </option>
                                            </div>
                                        </select>
                                    </td>

                                    <td class="p-[10px] border ">
                                        7 Marks
                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" name="totalAtf7" id="totalAtf7"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($atf7InDb == 0) {
                                                echo "disabled";
                                            }
                                            ?>>

                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" name="optionalAtf7" id="optionalAtf7"
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"
                                            value="0" min="0" <?php
                                            if ($atf7InDb == 0) {
                                                echo "disabled";
                                            }
                                            ?>>

                                    </td>
                                    <td class="p-[10px] border ">

                                        <input type="number" id="atf7InDb" name="atf7InDb"
                                            value="<?php echo $atf7InDb; ?>" disabled
                                            class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">

                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-[10px] border " colspan="2">
                                        <p>Total Marks of Selected Questions : <span class="text-red-500 font-semibold"
                                                id="totalSelectedMarksSection">0</span> </p>
                                    </td>
                                    <td class="p-[10px] border " colspan="4">
                                        <input type="submit" value="Lock and Proceed" id="btnSubmit" name="lockhojabhai"
                                            class="px-5 w-full py-2 bg-white text-red-500 border border-red-500 hover:bg-red-500 hover:text-white rounded-lg shadow-xl">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>

                </section>
            </section>

        </main>


        <!--------------------------------------------------------- PreLoader ------------------------------------------------------>


            <div id="preLoader" class="absolute h-[100vh] z-50 w-[100vw] top-0 bg-white"></div>

        <!--------------------------------------------------------- ------------------------------- ------------------------------------------------------>


        <script type="text/javascript">
            $(document).ready(() => {
                $("#preLoader").hide();

                let totalMarksForMcqs = 0;
                let totalMarksForFib = 0;
                let totalMarksForTf = 0;
                let totalMarksForAtf1 = 0;
                let totalMarksForAtf2 = 0;
                let totalMarksForAtf3 = 0;
                let totalMarksForAtf4 = 0;
                let totalMarksForAtf5 = 0;
                let totalMarksForAtf7 = 0;

                let grandTotal = 0;

                $("#btnSubmit").prop("disabled", true);

                // ---------------------------- Validation for Total Values ------------------------------------

                $("#totalMcqs").keyup(function () {
                    valueValidation("mcqsInDb", "totalMcqs", true)
                    totalMarksForMcqs = calculateQtypeWiseMarks("totalMcqs", "optionalMcqs", 1);
                })

                $("#totalFib").keyup(function () {
                    valueValidation("fibInDb", "totalFib", true)
                    totalMarksForFib = calculateQtypeWiseMarks("totalFib", "optionalFib", 1);

                })

                $("#totalTf").keyup(function () {
                    valueValidation("tfInDB", "totalTf", true)
                    totalMarksForTf = calculateQtypeWiseMarks("totalTf", "optionalTf", 1);

                })

                $("#totalAtf1").keyup(function () {
                    valueValidation("atf1InDb", "totalAtf1", true);
                    totalMarksForAtf1 = calculateQtypeWiseMarks("totalAtf1", "optionalAtf1", 1);
                })

                $("#totalAtf2").keyup(function () {
                    valueValidation("atf2InDb", "totalAtf2", true);
                    totalMarksForAtf2 = calculateQtypeWiseMarks("totalAtf2", "optionalAtf2", 2);
                })

                $("#totalAtf3").keyup(function () {
                    valueValidation("atf3InDb", "totalAtf3", true);
                    totalMarksForAtf3 = calculateQtypeWiseMarks("totalAtf3", "optionalAtf3", 3);
                })
                $("#totalAtf4").keyup(function () {
                    valueValidation("atf4InDb", "totalAtf4", true)
                    totalMarksForAtf4 = calculateQtypeWiseMarks("totalAtf4", "optionalAtf4", 4);
                })
                $("#totalAtf5").keyup(function () {
                    valueValidation("atf5InDb", "totalAtf5", true);
                    totalMarksForAtf5 = calculateQtypeWiseMarks("totalAtf5", "optionalAtf5", 5);
                });
                $("#totalAtf7").keyup(function () {
                    valueValidation("atf7InDb", "totalAtf7", true);
                    totalMarksForAtf7 = calculateQtypeWiseMarks("totalAtf7", "optionalAtf7", 7);
                });

                //  ----------------------------------------------------------------------------------------



                // ---------------------------- Validation for Optional Values ------------------------------------

                $("#optionalMcqs").keyup(function () {
                    valueValidation("totalMcqs", "optionalMcqs")
                    totalMarksForMcqs = calculateQtypeWiseMarks("totalMcqs", "optionalMcqs", 1);
                })

                $("#optionalFib").keyup(function () {
                    valueValidation("totalFib", "optionalFib")
                    totalMarksForFib = calculateQtypeWiseMarks("totalFib", "optionalFib", 1);
                })

                $("#optionalTf").keyup(function () {
                    valueValidation("totalTf", "optionalTf");
                    totalMarksForTf = calculateQtypeWiseMarks("totalTf", "optionalTf", 1);
                })

                $("#optionalAtf1").keyup(function () {
                    valueValidation("totalAtf1", "optionalAtf1");
                    totalMarksForAtf1 = calculateQtypeWiseMarks("totalAtf1", "optionalAtf1", 1);

                })

                $("#optionalAtf2").keyup(function () {
                    valueValidation("totalAtf2", "optionalAtf2");
                    totalMarksForAtf2 = calculateQtypeWiseMarks("totalAtf2", "optionalAtf2", 2);
                })

                $("#optionalAtf3").keyup(function () {
                    valueValidation("totalAtf3", "optionalAtf3");
                    totalMarksForAtf3 = calculateQtypeWiseMarks("totalAtf3", "optionalAtf3", 3);
                })
                $("#optionalAtf4").keyup(function () {
                    valueValidation("totalAtf4", "optionalAtf4");
                    totalMarksForAtf4 = calculateQtypeWiseMarks("totalAtf4", "optionalAtf4", 4);
                })
                $("#optionalAtf5").keyup(function () {
                    valueValidation("totalAtf5", "optionalAtf5");
                    totalMarksForAtf5 = calculateQtypeWiseMarks("totalAtf5", "optionalAtf5", 5);
                });
                $("#optionalAtf7").keyup(function () {
                    valueValidation("totalAtf7", "optionalAtf7");
                    totalMarksForAtf7 = calculateQtypeWiseMarks("totalAtf7", "optionalAtf7", 7);
                });

                //  ----------------------------------------------------------------------------------------



                function valueValidation(total, optional, flag) {
                    var totalInput = $("#" + total);
                    var optionalInput = $("#" + optional);

                    // Attach a keyup event handler to the optional input field
                    var totalValue = parseInt(totalInput.val());
                    var optionalValue = parseInt(optionalInput.val());

                    if (isNaN(totalValue)) {
                        optionalInput.val(0); // Set optional value to total value
                        totalInput.val(0); // Set optional value to total value
                        return;
                    }

                    if (flag) {

                        if (optionalValue > totalValue) {
                            optionalInput.val(totalValue); // Set optional value to total value
                        }
                    }
                    else {
                        if (optionalValue >= totalValue) {
                            optionalInput.val(totalValue - 1); // Set optional value to total value
                        }

                    }

                    // Check if optional value is greater than total value

                }

                function calculateQtypeWiseMarks(total, optional, weightage) {

                    var totalInput = $("#" + total);
                    var optionalInput = $("#" + optional);

                    // Attach a keyup event handler to the optional input field
                    var totalValue = parseInt(totalInput.val());
                    var optionalValue = parseInt(optionalInput.val());

                    if (isNaN(totalValue)) {
                        totalValue = 0;
                        return 0;
                    }
                    if (isNaN(optionalValue)) {
                        optionalValue = 0;
                    }



                    let totalMarks = (totalValue - optionalValue) * weightage;
                    calculateTotalMarks();
                    return totalMarks;
                }


                function calculateTotalMarks() {
                    setTimeout(() => {
                        let total = (totalMarksForAtf1 + totalMarksForAtf2 + totalMarksForAtf3 + totalMarksForAtf4 + totalMarksForAtf5 + totalMarksForAtf7 + totalMarksForFib + totalMarksForMcqs + totalMarksForTf);
                        $("#totalSelectedMarksSection").text(total);
                        if (total != $("#totalSetMarks").val()) {
                            $("#totalSelectedMarksSection").removeClass("text-green-500");
                            $("#totalSelectedMarksSection").addClass("text-red-500");
                            $("#btnSubmit").prop("disabled", true);
                        }
                        else {
                            $("#totalSelectedMarksSection").removeClass("text-red-500");
                            $("#totalSelectedMarksSection").addClass("text-green-500");
                            $("#btnSubmit").prop("disabled", false);
                        }
                    }, 500)
                }


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