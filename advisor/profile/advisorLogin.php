<?php

// Start session and set Common 
session_start();
include('../../class/helper/CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

// If information is entered
if (isset($_POST['tfUser']) && isset($_POST['pwPassword']))
  {
    // For validating password
    $userName = $_POST['tfUser'];
    $userPassword = md5($_POST['pwPassword']); // Hashed
    
    $sql = "select `ID`, `Username`, `Password` from `Advisor` 
           where `Username`='$userName'";
    $rs = $COMMON->executeQuery($sql,$_SERVER['SCRIPT_NAME']);
    $row = mysql_fetch_assoc($rs);

    // Check for password match. If match, enter advisor mangager
    if ($row['Password'] != NULL && $userPassword == $row['Password'])
      {
	$_SESSION['UserID'] = $row['ID'];
	$_SESSION['UserMSG'] = "Welcome ".$row['Username']." to your management page!";
	header('Location: advisorManager.php');
      }

    // Otherwise, get login again with error message
    else
      {getLogin(true);}

  }

  // If info not entered, get login without error message
  else
    {getLogin(false);}
  
// Name: getLogin  
// PreConditions: Supply true for error message. False for none.
// PostConditions: Html form displayed to get username and password
//                 for login with/without error message.
//                 Link to advisor registration at bottom
function getLogin($warning)
  {
    // Give error message
    if ($warning)
      {echo("Username and/or Password Incorrect");}
    ?>

    <html>
    <head>
    <title>Advisor Login</title>
    </head>
    <body>

    <!--Get Password and Name-->

    <form action="advisorLogin.php" method='post'>
      
      Username:<input type="text" size="8" maxlength="8" name="tfUser"><br>
      Password:<input type="password" size="8" maxlength="8" name="pwPassword"><br>

      <input type="Submit" value="Login">

    </form>

    <a href="advisorRegister.html">Click here if you have not yet registered!</a>

    </body>
    </html>
  
    <?php
  }

?>