<!DOCTYPE html>
<html>
    <head>
        <title>Advising</title>
        <link rel="stylesheet" type="text/css" href="../../style/main.css">
    </head>
    <body>
        <div class="container">
            <nav class="nav">
                <ul>
                    <li>
                        <a href="../../student/appointments/appointments.php"> Back to appointments </a>
                    </li>
                </ul>
            </nav>
            <h1> Your Profile </h1>
            <div id="appointmentContainer">
                <p><?php echo($tStudent->firstName)?></p>
                <p><?php echo($tStudent->lastName)?></p>
                <p><?php echo($tStudent->studentID)?></p>
                <p><?php echo($tStudent->email)?></p>
                <p><?php echo($tStudent->major)?></p>
            </div>
        </div>
    </body>
</html>