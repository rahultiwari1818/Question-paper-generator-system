<?php 

    session_start();

    include("../Partials/connection.php");
    if(!isset($_SESSION["uId"]) || $_SESSION["role"]!="ADMIN"){
        header("location:../login.php");
        exit;
    }


    $className = "";
    $classErr  = "";
    $successfull = false;
    $error = false;
    if(isset($_POST["addhojabhai"]) && $_POST["addhojabhai"] == "Add"){
        $className = $_POST["class"];
        $className = trim($className);
        
        if(empty($className)){
            $classErr  = "Please Enter ClassName .!";
            $error = true;
        }
        if(!$error){
            $sql = "insert into tbl_class values(NULL,'$className')";
            $result = mysqli_query($conn,$sql);
            if($result == TRUE){
                $successfull = true;
                $className= "";
                $classErr="";
            }
            else{
                $successfull = true;
            }
        }
    }

    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Class</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../script/script.js"></script>
    <script src="../script/jquery-3.6.3.js"></script>
</head>
<body style="background:url('../Assets/images/background.jpg')">

    <?php 
        if($successfull){
            echo "
                <section class='p-[3vw] w-[100vw]  bg-green-500 absolute top-0 shadow-xl' id='successMessage'>
                <p class='  absolute top-5 right-5 cursor-pointer' onclick='removeMsg()'>
                    x
                </p>
        
                    <p class='flex justify-center items-center'> Class added Successfully</p>
                </section>
            ";
        }
    ?>

    <h2 class="text-2xl text-center p-5 text-white">Add New Class </h2>
    <div class="flex justify-center items-center">
        <div class=" p-10 rounded-xl shadow-xl bg-blue-500">
            <form action="addClass.php" method="post">
                <div>
                    <input type="text" name="class" id="className"  value="<?php echo $className;?>" required  placeholder="Class Name" class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"  onkeyup="checkClassExists()">
                    <p class='text-red-500 my-3 ' id='classNameErr'>      </p>
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
    <div class="my-5">
            <h2 class="text-white text-2xl text-center"> List Of Existing Classes</h2>
            <div class="flex justify-center items-center my-5">
                        <table class="text-white">
                            <thead class="text-xl">
                                <tr>
                                    <td class="border p-[10px]">Sr NO</td>
                                    <td class="border p-[10px]">Class</td>
                                </tr>
                            </thead>
                            <tbody id="classTableTbody" class="text-lg">
        
                            </tbody>
                        </table>
            </div>
    </div>

    <script type="text/javascript">
        $(document).ready(()=>{

            function fetchClasses(){
                fetch("http://localhost/qpg/Partials/fetchClasses.php")
                .then(res=>res.json())
                .then(res=>{
                    let data = res?.data;
                    let srno  = 1;
                    let rows = "";
                    // console.log(res)
                    data.forEach((row)=>{
                        let tr = `<tr>
                            <td class="border p-[10px]">${srno}</td>
                            <td class="border p-[10px]">${row.class}</td>
                            </tr>
                        `;
                        rows+=tr;
                        srno+=1;            
                    })
                    // console.log("called")
                    $("#classTableTbody").html(rows);
            })
}

            fetchClasses();
            
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