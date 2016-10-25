<!DOCTYPE html>
<html>
    <head>
        <title>Advising</title>
        <link rel="stylesheet" type="text/css" href="/style/main.css" />
    </head>
    <body>
        <div class="container">
            <a id="advisorlogin" href="/student/profile/studentProfile.php"> Welcome, <?php echo($tStudentName)?> </a>
            
            <h1> Appointments </h1>
            <?php if (isset($tMsg)): ?>
            <div class="success">
            <?php echo($tMsg); ?>
            </div>
            <?php endif; ?>
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