<?php
require("../../class/Appointment.php");
require("../../class/helper/CommonMethods.php");

session_start();

if (!empty($_POST))
{
    // Make the student->appt pair in the db

    $db = new Common(false);
    $apptID = $_POST["id"];
    $studentID = $_SESSION["studentID"];
    $result = $db->executeQuery("INSERT INTO `StudentAppt` (`StudentID`, `ApptID`) VALUES ('$studentID', '$apptID')", "appointments.php");
}
else
{
    echo($_SESSION['studentID']);
    $db = new Common(false);
    $result = $db->executeQuery("SELECT * FROM `Appointment`", "appointments.php");
    $appts = array();
    
    while($row = mysql_fetch_assoc($result))
    {
        array_push($appts, new Appointment($row["ID"], $row["Date"], $row["StartTime"], $row["Location"], $row["Type"]));
    }

    $tStudentName = $_SESSION['studentFirstName'];

    require("./template/appointments.php");
}
?>