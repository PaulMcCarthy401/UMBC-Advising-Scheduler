<?php

// CONSTANTS
define("HOUR","60"); // Minutes in an hour   
define("APPT_LENGTH","30"); // Length of appointment in minutes

// Start session and set Common
session_start();
include('../../class/helper/CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

// Tell the advisor anything they should know
echo("MESSAGE CENTER: ".$_SESSION['UserMSG']."<br>");

?>

<!--Forms-->

<html>
<head>
<title>Advisor Manager</title>
</head>
<body>

<a href="gateway.html">Logout</a><br>

<br>ADD APOINTMENT:<br>
To add an appointment, enter your appointment info below.<br>
Appointments can be made starting 8AM to 4PM and are 30 minutes long.<br><br>

  <!--Get Appointment info-->

  <form action="addAppointment.php" method='post'>

    Date:<input type="date" name="dtDate"><br>
    Time:<input type="time" name="tiTime"><br>
    Location:<input type="text" size="20" maxlength="20" name="tfLocation"><br>

    Appointment Type:<br>

    <input type="radio" name="rbType" value="Group" checked>
    Group<br>
    <input type="radio" name="rbType" value="Single">
    Single<br>

    <input type="Submit" value="Add Appointment"><br>

  </form>

  <br>REMOVE APPOINTMENT:<br>
  To remove an appointment, select an ID from your active appointments shown below.<br><br>
  
  <!--Remove appointment-->

  <form action="removeAppointment.php" method='post'>

    
    Appt ID of appointment to remove:
    <input type="number" size="3" maxlength="3" min="1" name="nbApptID"><br>

    <input type="Submit" value="Remove Appointment"><br>

  </form>

</body>
</html>

<!--Show Appointments-->
  
<?php

echo("<br>YOUR APPOINTMENTS:<br><br>");

// For getting appointments
$AdvisorID = $_SESSION['UserID'];
$sqlAppts = "select * from `Appointment` where `ID` in (select `ApptID` 
            from `AdvisorAppt` where `AdvisorID`='$AdvisorID')
            order by `Date` asc, `StartTime` asc";
$rsAppt = $COMMON->executeQuery($sqlAppts,$_SERVER['SCRIPT_NAME']);

$apptPlace = 1; // Appointment output list place starting at 1

// If no appts
if (mysql_num_rows($rsAppt) == 0)
  {echo("NO APPOINTMENTS");}

else
  {
    // For each Appt 
    while ($apptRow = mysql_fetch_assoc($rsAppt))
      {
	// Establish end time
	$endTime = explode(":",$apptRow['StartTime']);
	$endTime[1] = intval($endTime[1]) + APPT_LENGTH;
	$endTime[0] = (int)(intval($endTime[0]) + $endTime[1] / 60);
	$endTime[1] = $endTime[1] % 60;
	
	// Establish Appt ID
	$ApptID = $apptRow['ID'];
	
	// Show Appt info 
	echo($apptPlace.".<br>Date: ".$apptRow['Date'].
	     "<br>Start Time: ".$apptRow['StartTime'].
	     "<br>End Time: ".$endTime[0].":".
	     str_pad($endTime[1],2,'0',STR_PAD_LEFT)."<br>Location: ".
	     $apptRow['Location']."<br>Type: ".$apptRow['Type'].
	     "<br>Appt ID: ".$ApptID."<br><br>");
	
	// For getting students
	$sqlStudent = "select * from `Student` where `ID` in (select 
        `StudentID` from `StudentAppt` where `ApptID`='$ApptID')
        order by `LastName` asc, `FirstName` asc";
        $rsStudent = $COMMON->executeQuery($sqlStudent,$_SERVER['SCRIPT_NAME']);
	
	// If no students
	if (mysql_num_rows($rsStudent) == 0)
	  {echo("--- NO STUDENTS IN THIS APPOINTMENT<br>");}
	
	// If students in appointment
	else
	  {      
	    // For each student in Appt 
	    while ($studentRow = mysql_fetch_assoc($rsStudent))
	      {
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
