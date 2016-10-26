<!DOCTYPE html>
<html>
    <head>
        <title>Advising</title>
        <link rel="stylesheet" type="text/css" href="/style/main.css" />
    </head>
    <body>
        <div class="container">
            <nav class="nav">
                <ul>
                    <li>
                        <a href="/student/profile/studentProfile.php"> Welcome, <?php echo($tStudentName)?></a>
                        |
                        <a href="/student/profile/logout.php"> Logout </a>
                    </li>
                </ul>
            </nav>
            
            <h1> Appointments </h1>
            <?php if (isset($tMsg)): ?>
            <div class="success">
            <?php echo($tMsg); ?>
            </div>
            <?php endif; ?>
            <div id="appointmentContainer">
                <table class="appointments">
                    <thead>
                        <th> Day </th>
                        <th> Time </th>
                        <th> Location </th>
                        <th> Type </th>
                    </thead>
                    <tbody>
                    <?php foreach ($appts as $appt): ?>
                    <form action="/student/appointments/confirmAppointment.php" method="POST">
                        <input type="hidden" name="id" value=<?php echo("\"".$appt->id."\"") ?> />
                        <tr>
                        <td> <?php echo($appt->date); ?> </td>
                        <td> <?php echo($appt->startTime); ?> </td>
                        <td> <?php echo($appt->location); ?> </td>
                        <td> <?php echo($appt->type); ?> </td>
                        <td> <input type="submit" value="Select" /> </td>
                        </tr>
                    </form>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>