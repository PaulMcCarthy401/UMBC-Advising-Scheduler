<?php
session_start();

require('../../config/config.php');
require(PROJROOT."/class/Appointment.php");
require_once(PROJROOT.'/class/helper/CommonMethods.php');

$query = "SELECT * FROM `Appointment`";

// If the user chooses an appointment type
if (isset($_GET['appt_type'])) {
    if ($_GET['appt_type'] == 'Group') {
        // Only queries for group appointments.
        $query = "SELECT * FROM `Appointment` WHERE `TYPE`='G'";
    } else if ($_GET['appt_type'] == 'Single') {
        // Only queries for single type appointents.
        $query = "SELECT * FROM `Appointment` WHERE `TYPE`='S'";
    }
}

$db = new Common(false);
$result = $db->executeQuery($query, "appointments.php");
$appts = array();

while ($row = mysql_fetch_assoc($result)) {
    array_push($appts, new Appointment($row['ID'], $row['Date'], $row['StartTime'], $row['Location'], $row['Type']));
}

$tStudentName = $_SESSION['studentFirstName'];
require(PROJROOT.'/student/appointments/template/appointments.php');

?>