<?php
require('../../config/config.php');

require(PROJROOT."/class/helper/CommonMethods.php");
require(PROJROOT."/class/Student.php");

session_start();

// Check if the user tried to login
$tPageError = NULL;

if (!empty($_POST)) {
    // Put all our form input into an array so it's easy to manage
    $form = array(
        "first_name" => $_POST["first_name"],
        "last_name" => $_POST["last_name"],
        "student_id" => $_POST["student_id"],
        "email" => $_POST["email"],
        "major" => $_POST["major"]
    );

    // Escape all form input
    array_map("mysql_real_escape_string", $form);

    // Once input is ready, put it into an object
    $student = new Student(
        $form["first_name"],
        $form["last_name"],
        $form["student_id"],
        $form["email"],
        $form["major"]
    );
    
    // Create a new template array for logging input errors. 
    $tPageError = array();

    if (!$student->isEmailValid()) {
        array_push($tPageError, "You have entered an invalid email.");
    }
    if (!preg_match("/[A-Za-z]{2}[0-9]{5}/", $student->studentID)) {
        array_push($tPageError, "Your student ID does not match the required format (AB12345).");
    }
    
    // Everything is valid.
    if (count($tPageError) == 0) {
        $db = new Common(false);

        // First, check if there is already an existing user tied to this
        // student ID
        $query = "
        SELECT *
        FROM `Student`
        WHERE `StudentID`='$student->studentID'
        ";
        $result = $db->executeQuery($query, "index.php");
        $id = -1;
        
        // If we find that the user already has an assiociated ID
        if (mysql_num_rows($result) != 0) {
            $id = mysql_fetch_assoc($result)['ID'];
        }
        else {
            $query = "
            INSERT INTO `Student` (`FirstName`, `LastName`, `StudentID`, `Email`, `Major`)
            VALUES ('$student->firstName', '$student->lastName', '$student->studentID', '$student->email', '$student->major');
            ";
            $result = $db->executeQuery($query, "index.php");

            // Grab the resultant id from the new student
            // we've created in the database.
            $id = mysql_insert_id();
        }

        if ($id == -1) {
            die("Error: something wrong with ID");
        }

        $_SESSION['studentID'] = $id;
        $_SESSION['studentFirstName'] = $student->firstName;

        header("Location: ../appointments/appointments.php");
    } else {
        require("./template/studentLogin.php");
    }
} else {
    // Otherwise, render the page
    require("./template/studentLogin.php");
}


?>