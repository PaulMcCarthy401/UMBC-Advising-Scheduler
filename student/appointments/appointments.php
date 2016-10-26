<?php
require('../../config/config.php')
require(PROJROOT."/class/Appointment.php");
require(PROJROOT."/class/helper/CommonMethods.php");

session_start();

$db = new Common(false);
$result = $db->executeQuery("SELECT * FROM `Appointment`", "appointments.php");
$appts = array();

while ($row = mysql_fetch_assoc($result)) {
    array_push($appts, new Appointment($row["ID"], $row["Date"], $row["StartTime"], $row["Location"], $row["Type"]));
}

$tStudentName = $_SESSION['studentFirstName'];
require("./template/appointments.php");
?>