<?php

require("/~seipp1/class/Advisor.php");

if (!empty($_POST)){
  //create new advisor object, store post data into object
  $advisor = new Advisor($_POST['tbFirstName'], $_POST['tbLastName'], $_POST['tbUsername'], $_POST['pwPassword'], $_POST['tbEmail']);

  $advisor.addNewAdvisor();

  require("./template/studentLogin.php");
}

?>