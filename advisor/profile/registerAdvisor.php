<?php
$config = require("../../config/config.php");
require($config['PROJROOT']."/class/Advisor.php");

if (!empty($_POST)) {
    // Create new advisor object, store post data into object
    $advisor = new Advisor($_POST['tbFirstName'], $_POST['tbLastName'], $_POST['tbUsername'], md5($_POST['pwPassword']), $_POST['tbEmail']);

    $advisor->addNewAdvisor();

    // Adding new advisor was successful
    header('Location: /advisor/profile/advisorLogin.php');
} else {
    require($config['PROJROOT']."/advisor/profile/template/registerAdvisor.php");
}

?>