<!DOCTYPE html>
<html>
	<head>
		<title> Advising </title>
		<link rel="stylesheet" type="text/css" href="/style/main.css">
	</head>
	<body>
		<div class="container">
			<h1> Advising </h1>
			<div>
				<form method="post" action="/advisor/profile/registerAdvisor.php">
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