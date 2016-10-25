<!DOCTYPE html>
<html>
    <head>
        <title>Advisor Login</title>
    </head>
    <body>
        <!--Get Password and Name-->
        <form action="advisorLogin.php" method='post'>
            <label for="tfUser"> Username: </label>
            <input type="text" size="8" maxlength="8" name="tfUser"><br>
            <label for="pwPassword"> Password: </label>
            <input type="password" size="8" maxlength="8" name="pwPassword"><br>

            <input type="submit" value="Login">
        </form>

        <a href="/advisor/profile/template/advisorRegister.html"> Click here if you have not yet registered! </a>

    </body>
</html>