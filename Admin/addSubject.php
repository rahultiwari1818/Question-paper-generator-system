<?php 
    session_start();

    include("../Partials/connection.php");
    if(!isset($_SESSION["uId"]) || $_SESSION["role"]!="ADMIN"){
        header("location:../login.php");
        exit;
    }

    $subject = "";
    $type = "";
    $class = "";
    $classErr = "";
    $typeErr = "";
    $subjectErr = "";


    if(isset($_POST["addhojabhai"]) && $_POST["addhojabhai"] == "Add"){
        $class = $_POST["class"];
        $subject = $_POST["subject"];
        $type = $_POST["type"];
        echo $class;
        echo $subject;

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../script/script.js"></script>
    <script src="../script/jquery-3.6.3.js"></script>
</head>
<body  style="background:url('../Assets/images/background.jpg')">
    <h2 class="text-2xl text-center p-5 text-white">Add New Subject </h2>

    <div class="flex justify-center items-center">
        <div class=" p-10 rounded-xl shadow-xl bg-blue-500">
            <form action="addSubject.php" method="post">
                <div class="my-2">
                    <input type="text" name="subject" id="subject"  value="<?php echo $subject;?>" required  placeholder="Subject Name" class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"  onkeyup="checkSubjectExists()">
                    <p class='text-red-500 my-3 ' id='subjectErr'>      </p>
                   <?php
                        if($subjectErr){
                            echo "<p class='text-red-500 my-3 '> $subjectErr </p>";
                        }
                    ?>
                </div>
                <div class="my-2">
                <select name="type" value="<?php echo $type;?>" required id="sub" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                        <div class="bg-white my-2">
                            <option value=""   <?php if($type=="") echo "selected"; ?>>-------- Select type -----------</option>
                            <option value="Practical"  <?php if($type=="Practical") echo "selected"; ?> >Practical</option>
                            <option value="Theory"  <?php if($type=="Theory") echo "selected"; ?>>Theory</option>
                        </div>
                    </select>
                    <?php
                        if($typeErr){
                            echo "<p class='text-red-500 my-3 '> $typeErr </p>";
                        }
                    ?>
                </div>
                <div class="my-2">
                <select name="class" value="<?php echo $class;?>" required id="classInSubject" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                        <div class="bg-white my-2">

                        </div>
                    </select>
                    <?php
                        if($classErr){
                            echo "<p class='text-red-500 my-3 '> $classErr </p>";
                        }
                    ?>
                </div>
                <div class="my-5">
                    <input type="submit" value="Add" name="addhojabhai" class="px-5 w-full py-2 bg-white text-red-500 border border-red-500 hover:bg-red-500 hover:text-white rounded-lg shadow-xl">
                </div>
            </form>
        </div>
        
    </div>

    <script>
        $(document).ready(()=>{
            fetchClassesInSubject();
        })
    </script>

        <!-- Script to Prevent Form Submission during Page Reload -->

        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>

</body>
</html>