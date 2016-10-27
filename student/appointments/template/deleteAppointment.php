<!DOCTYPE html>
<html>
    <head>
        <title>Advising</title>
        <link rel="stylesheet" type="text/css" href="../../style/main.css" />
    </head>
    <body>
        <div class="container">
            <nav class="nav">
                <ul>
                    <li>
                        <a href="../../student/profile/logout.php"> Logout </a>
                    </li>
                </ul>
            </nav>
            
            <h1> Confirm </h1>
            <p> Are you sure you want to cancel this meeting? </p>
            <table class="appointments">
                <thead>
                    <th> Day </th>
                    <th> Time </th>
                    <th> Location </th>
                    <th> Type </th>
                </thead>
                <tbody>
                    <tr>
                        <td> <?php echo($tAppt->date); ?> </td>
                        <td> <?php echo($tAppt->startTime)?> </td>
                        <td> <?php echo($tAppt->type); ?> </td>
                        <td> <?php echo($tAppt->location); ?> </td>
                    </tr>
                </tbody>
            </table>

            <div class="confirm">
                <form action="../../student/appointments/deleteAppointment.php" method="POST">
                    <input type="hidden" value="<?php echo $tAppt->id ?>" name='id'>
                    <input type="submit" value="Delete">
                </form>
                <form action="../../student/appointments/appointments.php">
                    <input type="submit" value="Cancel">
                </form>
            </div>

        </div>
    </body>
</html>