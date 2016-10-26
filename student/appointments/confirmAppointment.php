<?php
require_once('../../config/config.php');
require(PROJROOT.'/class/helper/CommonMethods.php');
require(PROJROOT.'/class/Appointment.php');

if(!empty($_POST)) {
    $id = $_POST['id'];

    $query = "
    SELECT *
    FROM `Appointment`
    WHERE ID=$id
    ";

    $db = new Common(false);
    $result = $db->executeQuery($query, "appointments.php");

    $row = mysql_fetch_assoc($result);
    $appt = new Appointment($row['ID'], $row['Date'], $row['StartTime'], $row['Location'], $row['Type']);

    $tAppt = $appt;

    require(PROJROOT.'/student/appointments/template/confirmAppointment.php');
} else {
    header('Location: /student/appointments/appointments.php');
}




?>