<?php

require_once('../../config/config.php');
require(PROJROOT.'/class/helper/CommonMethods.php');

class Advisor {
    public $id;
    public $firstName;
    public $lastName;
    public $username;
    private $password;
    public $email;

    public function __construct($firstName, $lastName, $username, $password, $email) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }

    public function addNewAdvisor() {
        $db = new Common(false);

        //verify advisor doesn't already exist in database
        $sql = "
        SELECT *
        FROM `Advisor`
        WHERE 'Username' = '".$this->username."'";
        $result = $db->executeQuery($sql, "Add Advisor");

        if (mysql_num_rows($result) == 0) {
            //if no rows returned, no username found, continue with insert
            $sql = "
            INSERT INTO `Advisor`(`Username`, `Password`, `Email`, `Salt`)
            VALUES ('".$this->username."','".$this->password."','".$this->email."','')
            ";
            $db->executeQuery($sql,"Register Advisor");
            echo "<script>alert('You have been added.');</script>";
        } else {
            echo "Username taken, please choose another.";
        }
    }
}
?>