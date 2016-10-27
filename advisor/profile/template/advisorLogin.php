<!DOCTYPE html>
<html>
    <head>
        <title>Advisor Login</title>
        <link rel="stylesheet" type="text/css" href="../../style/main.css">
    </head>
    <body>
        <div class="container">
            <nav class="nav">
                <ul>
                    <li>
                        <a href="../../student/profile/studentLogin.php"> Student Login </a>
                    </li>
                </ul>
            </nav>

            <h1> Advisor Login </h1>

            <?php if (isset($template['error'])): ?>
			<div class="invalid">
				<ul>
				<?php foreach ($template['error'] as $err): ?>
					<li> <?php echo($err); ?> </li>
				<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>

			<?php if (isset($template['success'])): ?>
			<div class="success">
				<ul>
				<?php foreach ($template['success'] as $err): ?>
					<li> <?php echo($err); ?> </li>
				<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>

            <!--Get Password and Name-->
            <form action="../../advisor/profile/advisorLogin.php" method='post'>
                <label for="tfUser"> Username: </label>
                <input type="text" size="32" maxlength="64" placeholder="username" name="tfUser"><br>
                <label for="pwPassword"> Password: </label>
                <input type="password" size="32" maxlength="64" placeholder="password" name="pwPassword"><br>

                <input type="submit" value="Login">
            </form>

            <a href="../../advisor/profile/registerAdvisor.php"> Click here if you have not yet registered! </a>
        </div>
    </body>
</html>