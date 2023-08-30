<?php
    session_start();

    if(!isset($_SESSION["uId"])){
        header("location: ./login.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./script/jquery-3.6.3.js"></script>
    <script src="./script/script.js"></script>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <main>

    </main>

    <footer class="bg-white bottom-0  p-[1vh] fixed w-screen ">
            <section class="flex justify-center items-center">
                <p class="font-serif antialiased font-black lg:text-xl text-base	"></p>
                Developed With <img src="./Assets/Icons/HeartIcon.svg" class="h-5 w-5 mx-2" alt="Heart Icon">
                 By Team LinkedList
            </section>
    </footer>

</body>
</html>