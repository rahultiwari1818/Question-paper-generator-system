<?php

    include("../Partials/connection.php");

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Questions</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="background:url('../Assets/images/background.jpg')">
    <?
        include("../Partials/navbar.php");
    ?>

    <main class="mt-5 ">
        <section class="flex justify-center items-center">
        
            <form action="uploadQuestions.php" method="post">
                <textarea name="question"  class="resize-none rounded-lg shadow-lg h-32 w-[80%]" value=""></textarea>
            </form>
        </section>
    </main>
</body>
</html>