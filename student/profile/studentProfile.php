<?php
require_once('../../config/config.php');
require(PROJROOT."/class/helper/CommonMethods.php");
require(PROJROOT."/class/Student.php");

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

require('./template/studentProfile.php');

?>