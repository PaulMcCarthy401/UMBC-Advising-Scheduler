<!DOCTYPE html>
<html>
    <head>
        <title>Advisor Login</title>
        <link rel="stylesheet" type="text/css" href="/style/main.css">
    </head>
    <body>
        <div class="container">
            <!--Get Password and Name-->
            <form action="advisorLogin.php" method='post'>
                <label for="tfUser"> Username: </label>
                <input type="text" size="8" maxlength="8" name="tfUser"><br>
                <label for="pwPassword"> Password: </label>
                <input type="password" size="8" maxlength="8" name="pwPassword"><br>

                <input type="submit" value="Login">
            </form>

            <a href="/advisor/profile/registerAdvisor.php"> Click here if you have not yet registered! </a>
        </div>
    </body>
</html>