<?php
require("../../class/helper/CommonMethods.php");
require("../../class/Student.php");

session_start();

$db = new Common(false);

$id = $_SESSION['studentID'];
$query = "
SELECT *
FROM `Student`
WHERE `ID`=$id
";
$result = $db->executeQuery($query, "studentProfile.php");

$studentInfo = mysql_fetch_assoc($result);

$tStudent = new Student(
    $studentInfo['FirstName'],
    $studentInfo['LastName'],
    $studentInfo['StudentID'],
    $studentInfo['Email'],
    $studentInfo['Major']
);

require("./template/studentProfile.php");
?>