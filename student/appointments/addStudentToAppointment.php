<?php
session_start();

$config = require('../../config/config.php');
require($config['PROJROOT'].'/class/helper/CommonMethods.php');
require($config['PROJROOT'].'/class/Appointment.php');

if (!empty($_POST)) {
    if (isset($_POST['id'])) {
        // Make the student->appt pair in the db
        $apptID = $_POST["id"];
        $studentID = $_SESSION["studentID"];
        $db = new Common(false);

        $query = "
        SELECT *
        FROM `StudentAppt`
        WHERE StudentID=$studentID
        ";

        $result = $db->executeQuery($query, "appointments.php");
        if (mysql_num_rows($result) > 0) {
            $tMsg = "You already have an appointment, please cancel it first.";
        } else {
            $query = "
            INSERT INTO `StudentAppt` (`StudentID`, `ApptID`)
            VALUES ('$studentID', '$apptID')
            ";
        
            $result = $db->executeQuery($query, "appointments.php");
            
            $tMsg = "Success, you have picked appointment ID: $apptID.";
        }

        

        require($config['PROJROOT'].'/student/appointments/template/appointments.php');
    }
} else {
    header('Location: /student/appointments/appointments.php');
}
?>