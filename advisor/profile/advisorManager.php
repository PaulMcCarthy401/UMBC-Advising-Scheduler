<?php
require_once('../../config/config.php');
require_once(PROJROOT.'/class/helper/CommonMethods.php');
session_start();

// CONSTANTS
define("HOUR", "60"); // Minutes in an hour   
define("APPT_LENGTH", "30"); // Length of appointment in minutes

// Set common
$debug = false;
$COMMON = new Common($debug);

// Tell the advisor anything they should know
echo("MESSAGE CENTER: ".$_SESSION['UserMSG']."<br>");

// Render main form
require(PROJROOT.'/advisor/profile/template/advisorManager.php');

/*** Begin rendering appointments ***/

echo("<br>YOUR APPOINTMENTS:<br><br>");

// For getting appointments
$AdvisorID = $_SESSION['UserID'];

$sqlAppts = "
SELECT * FROM `Appointment` WHERE `ID` IN (select `ApptID`
FROM `AdvisorAppt` WHERE `AdvisorID`='$AdvisorID')
ORDER BY `Date` asc, `StartTime` asc
";
$rsAppt = $COMMON->executeQuery($sqlAppts,$_SERVER['SCRIPT_NAME']);

$apptPlace = 1; // Appointment output list place starting at 1

// If no appts
if (mysql_num_rows($rsAppt) == 0) {
		echo("NO APPOINTMENTS");
}
else {
		// For each Appt 
  while ($apptRow = mysql_fetch_assoc($rsAppt)) {
    // Establish end time
    $amOrPm = "AM";

    $startTime = explode(":", $apptRow['StartTime']);

    switch ($startTime[0])
      {
      case "12":
	$amOrPm = "PM";
	break;
      case "13":
	$amOrPm = "PM";
	$startTime[0] = "01";
	break;
      case "14":
	$amOrPm = "PM";
	$startTime[0] = "02";
	break;
      case "15":
	$amOrPm = "PM";
	$startTime[0] = "03";
	break;
      case "16":
	$amOrPm = "PM";
	$startTime[0] = "04";
	break;
      default:
	break;
      }



    $endTime = $startTime;
    $endTime[1] = (int)(intval($endTime[1]) + APPT_LENGTH);
    $endTime[0] = (int)(intval($endTime[0]) + $endTime[1] / 60);

    switch ($endTime[0])
      {
      case 12:
	$amOrPmEnd = "PM";
	break;
      case 13:
	$amOrPmEnd = "PM";
	$endTime[0] = "01";
	break;
      case 14:
	$amOrPmEnd = "PM";
	$endTime[0] = "02";
	break;
      case 15:
	$amOrPmEnd = "PM";
	$endTime[0] = "03";
	break;
      case 16:
	$amOrPmEnd = "PM";
	$endTime[0] = "04";
	break;
      default:
	break;
      }
    $endTime[1] = $endTime[1] % 60;
    $endTime[2] = "00";
    // Establish Appt ID
    $ApptID = $apptRow['ID'];
    
    // Show Appt info 
    echo($apptPlace.".<br>Date: ".$apptRow['Date'].
	 "<br>Start Time: ".$startTime[0].":".$startTime[1].":".$startTime[2]." ".$amOrPm.
	 "<br>End Time: ".str_pad($endTime[0], 2, '0', STR_PAD_LEFT).":".str_pad($endTime[1], 2, '0', STR_PAD_LEFT).":".$endTime[2]." ".$amOrPm.
	 "<br>Location: ".$apptRow['Location'].
	 "<br>Type: ".$apptRow['Type'].
	 "<br>Appt ID: ".$ApptID."<br><br>");
    
    // For getting students
    $sqlStudent = "select * from `Student` where `ID` in (select 
				`StudentID` from `StudentAppt` where `ApptID`='$ApptID')
				order by `LastName` asc, `FirstName` asc";
    $rsStudent = $COMMON->executeQuery($sqlStudent,$_SERVER['SCRIPT_NAME']);
    
    // If no students
    if (mysql_num_rows($rsStudent) == 0) {
      echo("--- NO STUDENTS IN THIS APPOINTMENT<br>");
    }
    // If students in appointment
    else {      
      // For each student in Appt 
      while ($studentRow = mysql_fetch_assoc($rsStudent)) {
	// Show student info 
	echo("--- Name: ".$studentRow['FirstName']." ".
	     $studentRow['LastName']." ** Major: ".
	     $studentRow['Major']." ** Student ID: ".
	     $studentRow['StudentID']." ** Email: ".
	     $studentRow['Email']."<br>");
      }
      
    }
    
    echo("<br>");
    $apptPlace++; // Next output list place
  }
}

?>
