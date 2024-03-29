<!DOCTYPE html>
<html>
    <head>
        <title>Advisor Manager</title>
        <link rel="stylesheet" type="text/css" href="../../style/main.css">
    </head>
    <body>
        <div class="container">
            <a href="../../advisor/profile/logout.php">Logout</a><br>

            <h4> ADD APPOINTMENT: </h4>
            <p>To add an appointment, enter your appointment info below. </p>
            <p>Appointments can be made starting 8AM to 4PM and are 30 minutes long. </p>

            <!--Get Appointment info-->
            <form action="../../advisor/appointments/addAppointment.php" method='post'>

                    <label for="dtDate"> Date: </label>
                    <input type="date" name="dtDate" placeholder="MM/DD/YYYY" required autofocus><br>
                    
                    <label for="tiTime"> Time: </label>
                    <input type="time" name="tiTime" placeholder="HH:MM" required><br>

                    <label for="tfLocation"> Location: </label>
                    <input type="text" size="20" maxlength="20" name="tfLocation" placeholder="Room X" required><br>

                    <h4> Appointment Type: </h4>

                    <input type="radio" name="rbType" value="Group" checked>
                    Group <br>
                    <input type="radio" name="rbType" value="Single">
                    Single <br>

                    <input type="submit" value="Add Appointment">
            </form>

            <h4> REMOVE APPOINTMENT: </h4>
            <p>
                    To remove an appointment, select an ID from your active appointments shown below.
            </p>

            <!--Remove appointment-->
            <form action="../../advisor/appointments/removeAppointment.php" method='post'>
                <label for="nbApptID"> Appt ID of appointment to remove: </label>
                <input type="number" size="3" maxlength="3" min="1" name="nbApptID"><br>

                <input type="submit" value="Remove Appointment"><br>
            </form>
        </div>
    </body>
</html>