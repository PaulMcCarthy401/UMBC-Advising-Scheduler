<!DOCTYPE html>
<html>
    <head>
        <title>Advising</title>
        <link rel="stylesheet" type="text/css" href="./css/main.css" />
    </head>
    <body>
        <div id="container">
            <a id="advisorlogin" href="./studentprofile.php"> Welcome, <?php echo($tStudentName)?> </a>
            <h1> Appointments </h1>
            <div id="appointmentContainer">
                <table>
                    <thead>
                        <th> Day </th>
                        <th> Time </th>
                        <th> Location </th>
                        <th> Type </th>
                    </thead>
                    <tbody>
                    <?php foreach ($appts as $appt): ?>
                    <form action="./appointments.php" method="POST">
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