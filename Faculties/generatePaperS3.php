<?php
session_start();
include("../Partials/connection.php");

require_once '../vendor/autoload.php';


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

if(!isset($_SESSION["selectedClass"])|| (!$_SESSION["selectedSubject"])||(!$_SESSION["selectedSubject"])){
    header("location: ./generatePaper.php");
}

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

$paperContent = "";
$institute_name = $_SESSION["instituteName"];



$cid = $_SESSION["selectedClass"];
$sql = "select *  from tbl_class where cId = $cid";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
$class = $row["class"];

$sid = $_SESSION["selectedSubject"];
$sql = "select *  from tbl_subjects where sId = $sid";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
$subject = $row["subject"];

$total_marks = $_SESSION['totalMarks'];
$total_time = $_SESSION["totalTime"];

?>




<?php
$paperContent .= '<section style="border: 1px solid #000; padding: 0.5rem;">
    <section>
        <p style="text-align: center; font-size: 2rem; font-weight: bold;">
            ' . $institute_name . '
        </p>
    </section>
    <section>
        <section style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
            <p style="font-size: 1.5rem; margin-top: 1rem; font-weight: bold;">
                <span style="font-weight: bold;">Class:</span>
                ' . $class . '
            </p>
            <p style="font-size: 1.5rem; margin-top: 1rem; font-weight: bold;">
                <span style="font-weight: bold;">Subject:</span>
                ' . $subject . '
            </p>
        </section>
        <section style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
            <p style="font-size: 1.5rem; margin-top: 1rem; font-weight: bold;">
                <span style="font-weight: bold;">Total Marks:</span>
                <input type="number" value="' . $total_marks . '" style="background: transparent;border: none; outline: none;" disabled>
            </p>
            <p style="font-size: 1.5rem; margin-top: 1rem; font-weight: bold;">
                <span style="font-weight: bold;">Total Time:</span>
                ' . $total_time . ' <span style="font-weight: bold;">Minutes.</span>
            </p>
        </section>
    </section>
</section>
<section style="border: 2px solid #000; padding: 0.75rem;">';

if ($totalMcqs) {
    $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'mcqs'  ORDER BY RAND() limit $totalMcqs";
    $result = $conn->query($sql);

    $paperContent .= '<section style="margin-top: 1rem; padding-left: 1.25rem; padding-right: 1.25rem;">
        <section style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
            <p style="font-weight: bold; margin-left: -0.75rem;">Multiple Choice Questions. (Any ' . ($totalMcqs - $optionalMcqs) . ')</p>
            <p style="font-weight: bold;">(' . $totalMcqs . ')</p>
        </section>';

    $srno = 1;
    while ($row = $result->fetch_assoc()) {
        $paperContent .= '<section style="margin-top: 0.5rem;">
            <section style="display: flex; justify-content: flex-start; gap: 0.75rem;">
                <p>' . $srno .  '  . &nbsp; &nbsp;  ' .$row["question"].'</p>
        
            </section>
            <section>
                <p style="padding-left: 0.75rem;">A.' . $row["option1"] . '</p>
                <p style="padding-left: 0.75rem;">B.' . $row["option2"] . '</p>
                <p style="padding-left: 0.75rem;">C.' . $row["option3"] . '</p>
                <p style="padding-left: 0.75rem;">D.' . $row["option4"] . '</p>
            </section>
        </section>';

        $srno += 1;
    }

    $paperContent .= '</section>';
}

if ($totalFib) {
    $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'fib'  ORDER BY RAND() limit $totalFib";
    $result = $conn->query($sql);

    $paperContent .= '<section style="margin-top: 1rem; padding-left: 1.25rem; padding-right: 1.25rem;">
        <section style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
            <p style="font-weight: bold; margin-left: -0.75rem;">Fill In the Blanks. (Any ' . ($totalFib - $optionalFib) . ')</p>
            <p style="font-weight: bold;">(' . $totalFib . ')</p>
        </section>';

    $srno = 1;
    while ($row = $result->fetch_assoc()) {
        $paperContent .= '<section style="margin-top: 0.5rem;">
            <section style="display: flex; justify-content: flex-start; gap: 0.75rem;">
            <p>' . $srno .  '  . &nbsp; &nbsp;  ' .$row["question"].'</p>

            </section>
        </section>';

        $srno += 1;
    }

    $paperContent .= '</section>';
}

if ($totalTf) {
    $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'tf'  ORDER BY RAND() limit $totalTf";
    $result = $conn->query($sql);

    $paperContent .= '<section style="margin-top: 1rem; padding-left: 1.25rem; padding-right: 1.25rem;">
        <section style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
            <p style="font-weight: bold; margin-left: -0.75rem;">True or False. (Any ' . ($totalTf - $optionalTf) . ')</p>
            <p style="font-weight: bold;">(' . $totalTf . ')</p>
        </section>';

    $srno = 1;
    while ($row = $result->fetch_assoc()) {
        $paperContent .= '<section style="margin-top: 0.5rem;">
            <section style="display: flex; justify-content: flex-start; gap: 0.75rem;">
            <p>' . $srno .  '  . &nbsp; &nbsp;  ' .$row["question"].'</p>

            </section>
        </section>';

        $srno += 1;
    }

    $paperContent .= '</section>';
}

if ($totalAtf1) {
    $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'atf'  ORDER BY RAND() limit $totalAtf1";
    $result = $conn->query($sql);

    $paperContent .= '<section style="margin-top: 1rem; padding-left: 1.25rem; padding-right: 1.25rem;">
        <section style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
            <p style="font-weight: bold; margin-left: -0.75rem;">Answer The Following Questions - 1 Mark Each. (Any ' . ($totalAtf1 - $optionalAtf1) . ')</p>
            <p style="font-weight: bold;">(' . $totalAtf1 . ')</p>
        </section>';

    $srno = 1;
    while ($row = $result->fetch_assoc()) {
        $paperContent .= '<section style="margin-top: 0.5rem;">
            <section style="display: flex; justify-content: flex-start; gap: 0.75rem;">
                <p>' . $srno .  '  . &nbsp; &nbsp;  ' .$row["question"].'</p>

            </section>
        </section>';

        $srno += 1;
    }

    $paperContent .= '</section>';
}

if ($totalAtf2) {
    $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'atf'  ORDER BY RAND() limit $totalAtf2";
    $result = $conn->query($sql);

    $paperContent .= '<section style="margin-top: 1rem; padding-left: 1.25rem; padding-right: 1.25rem;">
        <section style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
            <p style="font-weight: bold; margin-left: -0.75rem;">Answer The Following Questions - 2 Marks Each. (Any ' . ($totalAtf2 - $optionalAtf2) * 2 . ')</p>
            <p style="font-weight: bold;">(' . ($totalAtf2 - $optionalAtf2) * 2 . ')</p>
        </section>';

    $srno = 1;
    while ($row = $result->fetch_assoc()) {
        $paperContent .= '<section style="margin-top: 0.5rem;">
            <section style="display: flex; justify-content: flex-start; gap: 0.75rem;">
            <p>' . $srno .  '  . &nbsp; &nbsp;  ' .$row["question"].'</p>

            </section>
        </section>';

        $srno += 1;
    }

    $paperContent .= '</section>';
}

if ($totalAtf3) {
    $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'atf'  ORDER BY RAND() limit $totalAtf3";
    $result = $conn->query($sql);

    $paperContent .= '<section style="margin-top: 1rem; padding-left: 1.25rem; padding-right: 1.25rem;">
        <section style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
            <p style="font-weight: bold; margin-left: -0.75rem;">Answer The Following Questions - 3 Marks Each. (Any ' . ($totalAtf3 - $optionalAtf3) * 3 . ')</p>
            <p style="font-weight: bold;">(' . ($totalAtf3 - $optionalAtf3) * 3 . ')</p>
        </section>';

    $srno = 1;
    while ($row = $result->fetch_assoc()) {
        $paperContent .= '<section style="margin-top: 0.5rem;">
            <section style="display: flex; justify-content: flex-start; gap: 0.75rem;">
            <p>' . $srno .  '  . &nbsp; &nbsp;  ' .$row["question"].'</p>

            </section>
        </section>';

        $srno += 1;
    }

    $paperContent .= '</section>';
}

if ($totalAtf4) {
    $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'atf'  ORDER BY RAND() limit $totalAtf4";
    $result = $conn->query($sql);

    $paperContent .= '<section style="margin-top: 1rem; padding-left: 1.25rem; padding-right: 1.25rem;">
        <section style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
            <p style="font-weight: bold; margin-left: -0.75rem;">Answer The Following Questions - 4 Marks Each. (Any ' . ($totalAtf4 - $optionalAtf4) * 4 . ')</p>
            <p style="font-weight: bold;">(' . ($totalAtf4 - $optionalAtf4) * 4 . ')</p>
        </section>';

    $srno = 1;
    while ($row = $result->fetch_assoc()) {
        $paperContent .= '<section style="margin-top: 0.5rem;">
            <section style="display: flex; justify-content: flex-start; gap: 0.75rem;">
            <p>' . $srno .  '  . &nbsp; &nbsp;  ' .$row["question"].'</p>

            </section>
        </section>';

        $srno += 1;
    }

    $paperContent .= '</section>';
}

if ($totalAtf5) {
    $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'atf'  ORDER BY RAND() limit $totalAtf5";
    $result = $conn->query($sql);

    $paperContent .= '<section style="margin-top: 1rem; padding-left: 1.25rem; padding-right: 1.25rem;">
        <section style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
            <p style="font-weight: bold; margin-left: -0.75rem;">Answer The Following Questions - 5 Marks Each. (Any ' . ($totalAtf5 - $optionalAtf5) * 5 . ')</p>
            <p style="font-weight: bold;">(' . ($totalAtf5 - $optionalAtf5) * 5 . ')</p>
        </section>';

    $srno = 1;
    while ($row = $result->fetch_assoc()) {
        $paperContent .= '<section style="margin-top: 0.5rem;">
            <section style="display: flex; justify-content: flex-start; gap: 0.75rem;">
            <p>' . $srno .  '  . &nbsp; &nbsp;  ' .$row["question"].'</p>

            </section>
        </section>';

        $srno += 1;
    }

    $paperContent .= '</section>';
}

if ($totalAtf7) {
    $sql = "SELECT * FROM tbl_questions WHERE classId = $classId AND subId = $subjectId AND uId = $userId AND q_type = 'atf'  ORDER BY RAND() limit $totalAtf7";
    $result = $conn->query($sql);

    $paperContent .= '<section style="margin-top: 1rem; padding-left: 1.25rem; padding-right: 1.25rem;">
        <section style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
            <p style="font-weight: bold; margin-left: -0.75rem;">Answer The Following Questions - 7 Marks Each. (Any ' . ($totalAtf7 - $optionalAtf7) * 7 . ')</p>
            <p style="font-weight: bold;">(' . ($totalAtf7 - $optionalAtf7) * 7 . ')</p>
        </section>';

    $srno = 1;
    while ($row = $result->fetch_assoc()) {
        $paperContent .= '<section style="margin-top: 0.5rem;">
            <section style="display: flex; justify-content: flex-start; gap: 0.75rem;">
            <p>' . $srno .  '  . &nbsp; &nbsp;  ' .$row["question"].'</p>

            </section>
        </section>';

        $srno += 1;
    }

    $paperContent .= '</section>';
}

$paperContent .= '</section>';
use \Mpdf\Mpdf;

$mpdf = new Mpdf();

$mpdf->WriteHTML($paperContent);
$mpdf->Output();


unset($_SESSION["selectedClass"]);
unset($_SESSION["selectedClass"]);
unset($_SESSION["totalMarks"]);
unset($_SESSION["totalTime"]);

?>

