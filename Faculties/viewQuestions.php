<?php
        include("../Partials/connection.php");
        $type = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Questions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../script/jquery-3.6.3.js"></script>
    <script src="../script/script.js"></script>
    
</head>
<body>

        <select name="type" id="viewtype" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"  onchange="filterByType()">
                        <div class="bg-white p-2">
                            <option value=""  <?php if($type=="") echo "selected";?>> ------- Select a Question Type ----------</option>
                            <option value="mcqs" <?php if($type=="mcqs") echo "selected";?>> MCQS </option>
                            <option value="fib" <?php if($type=="fib") echo "selected";?>> Fill In The Blanks</option>
                            <option value="tf"> <?php if($type=="tf") echo "selected";?>True Or False</option>
                            <option value="atf" <?php if($type=="atf") echo "selected";?>> Answer The Following Question. </option>
                        </div>
        </select>
        <input type="search" name="search"  id="searchQuestion" placeholder="Search Questions" class="block shadow-xl  my-1  appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" onkeyup="searchQuestion()" onblur="searchQuestion()"> 

    <table class="p-5 my-10">
        <thead>
        <tr>
            <th  class="p-[10px] border">Sr No</th>
            <th class="p-[10px] border">Question Type</th>
            <th class="p-[10px] border">Question</th>
            <th class="p-[10px] border">Options</th>
            <th class="p-[10px] border">Level</th>
            <th class="p-[10px] border">WeightAge</th>
            <th class="p-[10px] border">Date Added</th>
        </tr>
        </thead>
        <tbody id="questionsTbody">
        <?php
            $srno = 1;
            $sql = "select * from tbl_questions";
            $result = mysqli_query($conn,$sql);
            while($row = $result->fetch_assoc()){
                echo "<tr>
                    <td class='border p-[10px]' >".$srno."</td>
                    <td class='border p-[10px]' >".$row["q_type"]."</td>
                    <td class='border p-[10px]' >".$row["question"]."</td>
                    <td class='border p-[10px]' >".$row["options"]."</td>
                    <td class='border p-[10px]' >".$row["level"]."</td>
                    <td class='border p-[10px]' >".$row["weightage"]."</td>
                    <td class='border p-[10px]' >".$row["date_added"]."</td>
                </tr>";
                $srno= $srno+1;
            }
        ?>
        </tbody>
    </table>

</body>
</html>