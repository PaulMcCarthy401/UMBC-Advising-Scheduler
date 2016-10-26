<?php
require_once('../../config/config.php');
require_once(PROJROOT.'/class/helper/CommonMethods.php');

// CONSTANTS
define("HOUR","60"); // Minutes in an hour
define("EARLIEST","480"); // Earliest appointment start time 480mins == 8AM
define("LATEST","960"); // Latest appointment start time 960mins == 4PM
define("APPT_LENGTH","30"); // Length of appointment in minutes

// Start session and set Common
session_start();
$debug = false;
$COMMON = new Common($debug);

// If not all fields filled correctly, return to advisor manager
if (!(isset($_POST['dtDate']) &&  
      isset($_POST['tiTime']) && 
      isset($_POST['tfLocation'])) || 
    ($_POST['dtDate'] == null ||
     $_POST['tiTime'] == null ||
     $_POST['tfLocation'] == null)) {

    // Set message and return to advisor manager
    $_SESSION['UserMSG'] = "APPOINTMENT NOT ADDED! 
              Please enter all fields correctly to add appointment.";
    header('Location: /advisor/profile/advisorManager.php');
    exit();
}

// Set variables
$AdvisorID = $_SESSION['UserID'];
$Date = $_POST['dtDate'];
$Time = $_POST['tiTime']; 
$Location = $_POST['tfLocation'];     
$Type = $_POST['rbType'];     

// Set for validation
$timeInt = explode(":", $Time);
$timeInt = (intval($timeInt[0]) * HOUR) + intval($timeInt[1]);
$sqlValid = "
SELECT `StartTime` FROM `Appointment` WHERE `Date`='$Date' AND 
`ID` IN (select `ApptID` FROM `AdvisorAppt` 
WHERE `AdvisorID` = '$AdvisorID')
";

// Validate time. If not in, range do nothing
if ($timeInt < EARLIEST || $timeInt > LATEST)
{
    // Set message and return to advisor manager
    $_SESSION['UserMSG'] = "APPOINTMENT NOT ADDED! 
              Time not between 8AM and 4PM.";
    header('Location: /advisor/profile/advisorManager.php');
    exit();
}

// Validation no overlap. If overlap, do nothing
$rs = $COMMON->executeQuery($sqlValid, $_SERVER['SCRIPT_NAME']);

// Check for overlapping appointments
while ($row = mysql_fetch_assoc($rs))
{
    // Time where appointment can't be added
    $lowerTime = explode(":", $row['StartTime']);
    $lowerTime = (intval($lowerTime[0]) * HOUR) + intval($lowerTime[1]) - APPT_LENGTH;
    $upperTime = explode(":", $row['StartTime']);
    $upperTime = (intval($upperTime[0]) * HOUR) + intval($upperTime[1]) + APPT_LENGTH;
    
    // Check if overlap exists
    if ($timeInt > $lowerTime && $timeInt < $upperTime)
    {
        // Set message and return to advisor manager
        $_SESSION['UserMSG'] = "APPOINTMENT NOT ADDED! 
                        Appoint time overlaps with an existing appointment.";
        header('Location: /advisor/profile/advisorManager.php');
        exit();
    }
}
   
// If correct and no overlap (made it this far), add the appointment

// Add the Appointment
$sqlApptIn = "
INSERT INTO `Appointment` (`ID`,`Date`,`StartTime`,`Location`, `Type`)
VALUES ('','$Date','$Time','$Location','$Type')
";

$COMMON->executeQuery($sqlApptIn,$_SERVER['SCRIPT_NAME']);

// Add the AdvisorAppt
$ApptID = mysql_insert_id(); // Grab the index just inserted into
$sqlAdApptIn = "
INSERT INTO `AdvisorAppt` (`ID`,`AdvisorID`,`ApptID`) 
VALUES ('','$AdvisorID','$ApptID')";

$COMMON->executeQuery($sqlAdApptIn,$_SERVER['SCRIPT_NAME']);

// Set message and return to advisor manager
$_SESSION['UserMSG'] = "Appointment submitted.";
header('Location: /advisor/profile/advisorManager.php');

?>