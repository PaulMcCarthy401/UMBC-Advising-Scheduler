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
                    <a href="../../advisor/profile/advisorLogin.php"> Advisor Login </a>
                </li>
            </ul>
        </nav>
        <h1> Advising </h1>
            <div>
                <?php if (isset($tPageError)): ?>

                <div class="invalid">
                <ul>
                <?php foreach ($tPageError as $err): ?>
                <li> <?php echo($err); ?> </li>
                <?php endforeach; ?>

                <?php endif; ?>
                </ul>
                </div>
                <form action="../../student/profile/studentLogin.php" method="POST">
                    <label for="first_name"> First Name </label>
                    <input type="text" name="first_name" placeholder="John" required autofocus>
                    <br />

                    <label for="last_name"> Last Name </label>
                    <input type="text" name="last_name" placeholder="Doe" required>
                    <br />

                    <label for="student_id"> Student ID </label>
                    <input type="text" size="7" maxlength="7" name="student_id" pattern="[A-Za-z]{2}[0-9]{5}" placeholder="AA12345" required>
                    <br />
                    <label for="email"> E-Mail </label>
                    <input type="email" name="email" placeholder="example@example.com" required>
                    <br />

                    <label for="major"> Major </label>
                    <select name="major">
                        <option> Biological Sciences BA </option>
                        <option> Biological Sciences BS </option>
                        <option> Biochemistry &amp; Molecular Biology BS </option>
                        <option> Bioinformatics &amp; Computational Biology BS </option>
                        <option> Biology Education BA </option>
                        <option> Chemistry BA </option>
                        <option> Chemistry BS </option>
                        <option> Chemistry Education BA </option>
                        <option> Computer Science </option>
                        <option> Computer Engineering </option>
                    </select>
                    <br />
                    <input type="submit" value="continue">
                </form>
            </div>
        </div>
    </body>
</html>
