<?php
    session_start();
    require('../../config/config.php');
    require(PROJROOT.'/class/helper/CommonMethods.php');
    require(PROJROOT.'/class/Appointment.php');

    $db = new Common(false);
    $studentID = $_SESSION['studentID'];

    if (isset($_POST['id'])) {
        // Start deleting the appointment
        $query = "
        DELETE FROM `StudentAppt`
        WHERE `StudentID`='$studentID'
        ";
        $result = $db->executeQuery($query, "deleteAppointment.php");
        header('../../student/appointments/appointments.php');
    }

    $query = "
    SELECT *
    FROM `StudentAppt`
    WHERE `StudentID`='$studentID'
    ";

    $result = $db->executeQuery($query, "deleteAppointment.php");

    // Check if the student actually had an appointment.
    if (mysql_num_rows($result) < 1) {
        echo 'You don\'t have an appointment.';
    }

    // This will have returned the StudentID/ApptID pair.
    // We can cross-reference this with the Appointment table
    // to access the appointment data.
    $studentApptRow = mysql_fetch_assoc($result);
    $apptID = $studentApptRow['ApptID'];

    $query = "
    SELECT *
    FROM `Appointment`
    WHERE `ID`='$apptID'
    ";

    $result = $db->executeQuery($query, "deleteAppointment.php");
    $apptRow = mysql_fetch_assoc($result);

    $appt = new Appointment($apptRow['ID'], $apptRow['Date'], $apptRow['StartTime'], $apptRow['Location'], $apptRow['Type']);
    $tAppt = $appt;

    require(PROJROOT.'/student/appointments/template/deleteAppointment.php');
?>