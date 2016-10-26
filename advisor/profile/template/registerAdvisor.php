<!DOCTYPE html>
<html>
	<head>
		<title> Advising </title>
		<link rel="stylesheet" type="text/css" href="../../style/main.css">
	</head>
	<body>
		<div class="container">
			<nav class="nav">
                <ul>
                    <li>
                        <a href="../../advisor/profile/advisorLogin.php"> Back to login </a>
                    </li>
                </ul>
            </nav>
			
			<h1> Register </h1>

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

			<div>
				<form method="post" action="../../advisor/profile/registerAdvisor.php">
					<label for="tbFirstName"> First Name: </label> 
					<input type="text" name="tbFirstName" placeholder="John" required autofocus />
					<br/>

					<label for="tbLastName"> Last Name: </label> 
					<input type="text" name="tbLastName" placeholder="Doe" required />
					<br/>

					<label for="tbUsername"> Username: </label> 
					<input type="text" name="tbUsername" placeholder="Spartan117" required />
					<br/>

					<label for="pwPassword"> Password: </label> 
					<input type="password" name="pwPassword" required />
					<br/>

					<label for="tbEmail"> Email: </label> 
					<input type="email" name="tbEmail" placeholder="John.Doe@google.com" required />
					<br/>

					<input type="submit" value="Submit">
				</form>
			</div>
		</div>
	</body>
</html>