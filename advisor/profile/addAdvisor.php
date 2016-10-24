<?php

include('../../CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

$UserName = $_POST['tfUser'];
$Password = md5($_POST['pwPassword']);
$Email = $_POST['tfEmail'];

$sql = "
INSERT INTO `Advisor`(`ID`, `Username`, `Password`, `Email`, `Salt`)
VALUES ('', '$UserName', '$Password', '$Email', '')
";

$COMMON->executeQuery($sql, $_SERVER['SCRIPT_NAME']);

echo("Advisor added!<br>");

?>