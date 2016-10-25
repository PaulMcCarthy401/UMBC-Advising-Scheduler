<?php

// Start session and set Common
session_start();
include('../../class/helper/CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

// If not field not filled, do nothing
if (!(isset($_POST['nbApptID'])) || $_POST['nbApptID'] == null) {

    // Set message and return to advisor manager
    $_SESSION['UserMSG'] = "APPOINTMENT NOT REMOVED!
              Please enter an 'Appt ID' to remove appointment.";
    header('Location: /advisor/profile/advisorManager.php');
    exit();
}

// Set variables for validation and removal
$AdvisorID = $_SESSION['UserID'];
$ApptID = $_POST['nbApptID'];

$sqlValid =
"
SELECT *
FROM `AdvisorAppt`
WHERE `AdvisorID`='$AdvisorID'
AND `ApptID`='$ApptID'
";
$rs = $COMMON->executeQuery($sqlValid,$_SERVER['SCRIPT_NAME']);

// Check if appointment not available to remove
if (mysql_num_rows($rs) == 0) {
    // Set message and return to advisor manager
    $_SESSION['UserMSG'] = "APPOINTMENT NOT REMOVED! 
              That is not one of your appointments.
              Please enter one of your 'Appt ID' to remove an appointment.";
    header('Location: /advisor/profile/advisorManager.php');
    exit();
}
// Appointment is there
else {
    // Remove sql for AdvisorAppt, StudentAppt and Appointment
    $sqlRemoveAdAppt = "delete from `AdvisorAppt` where `ApptID`='$ApptID'";
    $sqlRemoveStAppt = "delete from `StudentAppt` where `ApptID`='$ApptID'";
    $sqlRemoveAppt = "delete from `Appointment` where `ID`='$ApptID'";

    // Remove Appt from AdvisorAppt
    $COMMON->executeQuery($sqlRemoveAdAppt,$_SERVER['SCRIPT_NAME']);

    // Remove Appt from StudentAppt
    $COMMON->executeQuery($sqlRemoveStAppt,$_SERVER['SCRIPT_NAME']);

    // Remove Appt from Appointment
    $COMMON->executeQuery($sqlRemoveAppt,$_SERVER['SCRIPT_NAME']);
    
    // Set message and return to advisor manager
    $_SESSION['UserMSG'] = "Appointment removed.";
    header('Location: /advisor/profile/advisorManager.php');
    exit();
}

?>