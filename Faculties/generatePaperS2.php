<?php
    session_start();
    include("../Partials/connection.php");


    if(!isset($_SESSION["uId"])){
        header("location: ../login.php");
        exit();
    }

    if((!isset($_SESSION["selectedClass"])) || (!isset($_SESSION["selectedSubject"])) || (!isset($_SESSION["totalMarks"])) || (!isset($_SESSION["totalTime"]))){
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
            <section class="p-5 rounded-xl shadow-xl bg-white text-blue-500">

                <p class="text-2xl bg-blue-500 text-white p-3 rounded-xl shadow-xl text-center">
                    Step 2
                </p>
                <section class="block md:flex justify-between items-center gap-5 my-5">
                    <p class="text-lg bg-blue-500 text-white p-2 my-2 rounded-xl shadow-xl text-center">
                      Class  :
                      <?php
                            $cid = $_SESSION["selectedClass"];
                            $sql = "select *  from tbl_class where cId = $cid";
                            $result = mysqli_query($conn,$sql);
                            $row = $result->fetch_assoc();
                            $class = $row["class"];
                            echo $class;
                        ?>
                    </p>
                    <p class="text-lg bg-blue-500 text-white p-2 my-2 rounded-xl shadow-xl text-center">
                      Subject  :
                      <?php
                            $sid = $_SESSION["selectedSubject"];
                            $sql = "select *  from tbl_subjects where sId = $sid";
                            $result = mysqli_query($conn,$sql);
                            $row = $result->fetch_assoc();
                            $subject = $row["subject"];
                            echo $subject;
                        ?> 
                    </p>
                    <p class="text-lg bg-blue-500 text-white p-2 my-2 rounded-xl shadow-xl text-center">
                      Total Marks :  <?php echo $_SESSION["totalMarks"];?>
                    </p>
                    <p class="text-lg bg-blue-500 text-white p-2 my-2 rounded-xl shadow-xl text-center">
                      Total Time :  <?php echo $_SESSION["totalTime"];?>
                    </p>
                </section>

                <section class="my-3">
                    <p class="text-lg bg-blue-500 text-white p-2 my-2 rounded-xl shadow-xl text-center">
                        Enter Your Paper Style
                    </p>
                </section>
                <!-- <form action="#" method="post">
                    <section class="my-2">
                        <select name="type" id="type" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" required>
                            <div class="bg-white p-2">
                                <option value=""> ------- Select a Question Type ----------</option>
                                <option value="mcqs" selected > MCQS </option>
                                <option value="fib" > Fill In The Blanks</option>
                                <option value="tf">True Or False</option>
                                <option value="atf"> Answer The Following Question. </option>
                            </div>
                        </select>
                    </section>
                    <section class="my-2">
                        <select name="type" id="type" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" required>
                        <div class="bg-white p-2">
                            <option value="" > ------- Select a Question Type ----------</option>
                            <option value="mcqs" selected> MCQS </option>
                            <option value="fib" selected > Fill In The Blanks</option>
                            <option value="tf"> True Or False</option>
                            <option value="atf" > Answer The Following Question. </option>
                        </div>
                    </select>
                    </section>
                    <section class="my-2">
                        <select name="type" id="type" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" required>
                        <div class="bg-white p-2">
                            <option value="" > ------- Select a Question Type ----------</option>
                            <option value="mcqs" selected> MCQS </option>
                            <option value="fib" > Fill In The Blanks</option>
                            <option value="tf" selected> True Or False</option>
                            <option value="atf" > Answer The Following Question. </option>
                        </div>
                    </select>
                    </section>
                    <section class="my-2">
                        <select name="type" id="type" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" required>
                        <div class="bg-white p-2">
                            <option value="" > ------- Select a Question Type ----------</option>
                            <option value="mcqs" > MCQS </option>
                            <option value="fib" > Fill In The Blanks</option>
                            <option value="tf"> True Or False</option>
                            <option value="atf" selected > Answer The Following Question. </option>
                        </div>
                    </select>
                    </section>
                    <section class="my-2">
                        <select name="type" id="type" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" required>
                        <div class="bg-white p-2">
                            <option value="" > ------- Select a Question Type ----------</option>
                            <option value="mcqs" selected> MCQS </option>
                            <option value="fib" > Fill In The Blanks</option>
                            <option value="tf"> True Or False</option>
                            <option value="atf" selected > Answer The Following Question. </option>
                        </div>
                    </select>
                    </section>
                    <section class="my-2">
                        <select name="type" id="type" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" required>
                        <div class="bg-white p-2">
                            <option value="" > ------- Select a Question Type ----------</option>
                            <option value="mcqs" selected> MCQS </option>
                            <option value="fib" > Fill In The Blanks</option>
                            <option value="tf"> True Or False</option>
                            <option value="atf" selected > Answer The Following Question. </option>
                        </div>
                    </select>
                    </section>
                    <section class="my-2">
                        <select name="type" id="type" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" required>
                        <div class="bg-white p-2">
                            <option value="" > ------- Select a Question Type ----------</option>
                            <option value="mcqs" selected> MCQS </option>
                            <option value="fib" > Fill In The Blanks</option>
                            <option value="tf"> True Or False</option>
                            <option value="atf" selected > Answer The Following Question. </option>
                        </div>
                    </select>
                    
                    </section>
                    <section class="my-2">
                        <select name="type" id="type" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" required>
                        <div class="bg-white p-2">
                            <option value="" > ------- Select a Question Type ----------</option>
                            <option value="mcqs" selected> MCQS </option>
                            <option value="fib" > Fill In The Blanks</option>
                            <option value="tf"> True Or False</option>
                            <option value="atf" selected > Answer The Following Question. </option>
                        </div>
                    </select>
                    </section>
                    <section class="my-2">
                        <select name="type" id="type" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" required>
                            <div class="bg-white p-2">
                                <option value="" > ------- Select a Question Type ----------</option>
                                <option value="mcqs" > MCQS </option>
                                <option value="fib"  > Fill In The Blanks</option>
                                <option value="tf">  True Or False</option>
                                <option value="atf" selected  > Answer The Following Question. </option>
                            </div>
                        </select>
                    </section>
                </form> -->
                    <form action="#" method="post">
                        <section class="">
                            <table  class="">
                                <thead  class="">

                                </thead>
                                <tbody  class="">

                                </tbody>
                            </table>
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
            $("#preLoader").hide();
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