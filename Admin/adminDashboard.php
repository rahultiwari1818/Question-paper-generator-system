<?php
    session_start();
    include("../Partials/connection.php");

    if(!isset($_SESSION["uId"]) || $_SESSION["role"]!="ADMIN"){
        header("location:../login.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin DashBoard</title>
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
        <section class="mx-10 my-10">
                <h2 class="bg-white text-blue-500 rounded-lg shadow-xl px-10 py-5 w-fit text-xl font-semibold">Welcome <? echo $_SESSION["fname"]; ?> </h2>
        </section>
        <section class="grid lg:grid-cols-3 md:grid-cols-2 gap-5 bg-white rounded-lg shadow-lg mx-10 my-2 p-5">
            <section class="px-5 py-5 rounded-lg shadow-lg bg-blue-500 text-white text-2xl font-semibold flex justify-center items-center">
                <section>
                    <p>
                        <?php
                            $sql = "select count(*) as count from tbl_users";
                            $result = mysqli_query($conn,$sql);
                            $row = $result->fetch_assoc();
                            $count = $row["count"];
                            echo $count;
                        ?>
                    </p>
                    <p class="mt-5 -ml-7">
                        <svg xmlns="http://www.w3.org/2000/svg" height="80px" width="80px" viewBox="0 0 640 512">
                             <path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z" fill="#fff"/>
                        </svg>
                    </p>
                    <p class="-ml-7">Users</p>
                </section>
            </section>

            <section class="px-5 py-5 rounded-lg shadow-lg bg-blue-500 text-white text-2xl font-semibold flex justify-center items-center">
               <section>
                    <p>
                        <?php
                            $sql = "select count(*) as count from tbl_class";
                            $result = mysqli_query($conn,$sql);
                            $row = $result->fetch_assoc();
                            $count = $row["count"];
                            echo $count;
                        ?>
                    </p>
                    <p class="mt-0 -ml-7">

                        <img src="../Assets/Icons/classIcon.svg" alt="" srcset="">

                    </p>
                    <p class="-ml-4">Classes</p>
               </section>
               
            </section>
            <section class="px-5 py-5 rounded-lg shadow-lg bg-blue-500 text-white text-2xl font-semibold flex justify-center items-center">
                <section>
                    <p>
                        <?php
                            $sql = "select count(*) as count from tbl_subjects";
                            $result = mysqli_query($conn,$sql);
                            $row = $result->fetch_assoc();
                            $count = $row["count"];
                            echo $count;
                        ?>
                    </p>
                    <p class="mt-5 -ml-7">
                        <svg xmlns="http://www.w3.org/2000/svg"  height="80px" width="80px" viewBox="0 0 576 512">
                            <path d="M249.6 471.5c10.8 3.8 22.4-4.1 22.4-15.5V78.6c0-4.2-1.6-8.4-5-11C247.4 52 202.4 32 144 32C93.5 32 46.3 45.3 18.1 56.1C6.8 60.5 0 71.7 0 83.8V454.1c0 11.9 12.8 20.2 24.1 16.5C55.6 460.1 105.5 448 144 448c33.9 0 79 14 105.6 23.5zm76.8 0C353 462 398.1 448 432 448c38.5 0 88.4 12.1 119.9 22.6c11.3 3.8 24.1-4.6 24.1-16.5V83.8c0-12.1-6.8-23.3-18.1-27.6C529.7 45.3 482.5 32 432 32c-58.4 0-103.4 20-123 35.6c-3.3 2.6-5 6.8-5 11V456c0 11.4 11.7 19.3 22.4 15.5z" fill="#fff"/>
                        </svg>
                    </p>
                    <p class="-ml-7">Subjects</p>
                </section>
            </section>
            <section class="px-5 py-5 rounded-lg shadow-lg bg-blue-500 text-white text-2xl font-semibold flex justify-center items-center">
                 <section >
                    <p>
                        <?php
                            $sql = "select count(*) as count from tbl_questions";
                            $result = mysqli_query($conn,$sql);
                            $row = $result->fetch_assoc();
                            $count = $row["count"];
                            echo $count;
                        ?>
                    </p>
                    <p class="mt-5 -ml-7">
                        <svg xmlns="http://www.w3.org/2000/svg" height="80px" width="80px" viewBox="0 0 512 512" fill="#fff">
                            <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM169.8 165.3c7.9-22.3 29.1-37.3 52.8-37.3h58.3c34.9 0 63.1 28.3 63.1 63.1c0 22.6-12.1 43.5-31.7 54.8L280 264.4c-.2 13-10.9 23.6-24 23.6c-13.3 0-24-10.7-24-24V250.5c0-8.6 4.6-16.5 12.1-20.8l44.3-25.4c4.7-2.7 7.6-7.7 7.6-13.1c0-8.4-6.8-15.1-15.1-15.1H222.6c-3.4 0-6.4 2.1-7.5 5.3l-.4 1.2c-4.4 12.5-18.2 19-30.6 14.6s-19-18.2-14.6-30.6l.4-1.2zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/>
                        </svg>
                    </p>
                    <p class="-ml-7">Questions</p>
                </section>
            </section>
        </section>
    </main>
    <footer class="bg-white bottom-0  p-[1vh] fixed w-screen ">
            <section class="flex justify-center items-center">
                <p class="font-serif antialiased font-black lg:text-xl text-base	"></p>
                Developed With <img src="../Assets/Icons/HeartIcon.svg" class="h-5 w-5 mx-2" alt="Heart Icon">
                 By Team LinkedList
            </section>
    </footer>
</body>
</html>