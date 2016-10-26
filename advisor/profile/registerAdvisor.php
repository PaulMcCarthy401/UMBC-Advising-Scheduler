<?php
require_once('../../config/config.php');
require(PROJROOT."/class/Advisor.php");

if (!empty($_POST)) {
    // Create new advisor object, store post data into object
    $advisor = new Advisor($_POST['tbFirstName'], $_POST['tbLastName'], $_POST['tbUsername'], md5($_POST['pwPassword']), $_POST['tbEmail']);

    $success = $advisor->addNewAdvisor();

    // Template used for rendering the success/error messages to the user.
    $template = array();
    // Adding new advisor was successful, so display the login page.
    if ($success == "SUCCESS") {
        $template['success'] = array(
            "Your registration was successful! Please login."
        );
        require(PROJROOT."/advisor/profile/advisorLogin.php");
    } else if ($success == "USERNAME_TAKEN") {
        $template['error'] = array(
            "Sorry, that username is taken. Please try again."
        );
        require(PROJROOT."/advisor/profile/template/registerAdvisor.php");
    }
} else {
    require(PROJROOT."/advisor/profile/template/registerAdvisor.php");
}

?>