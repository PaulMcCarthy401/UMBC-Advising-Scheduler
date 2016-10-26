<?php

require_once('../../config/config.php');

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
        require_once(PROJROOT.'/class/helper/CommonMethods.php');

        $db = new Common(false);

        //verify advisor doesn't already exist in database
        $sql = "
        SELECT *
        FROM `Advisor`
        WHERE `Username` = '".$this->username."'";
        $result = $db->executeQuery($sql, "Advisor.php");

        if (mysql_num_rows($result) == 0) {
            //if no rows returned, no username found, continue with insert
            $sql = "
            INSERT INTO `Advisor`(`Username`, `Password`, `Email`, `Salt`)
            VALUES ('".$this->username."','".$this->password."','".$this->email."','')
            ";
            $db->executeQuery($sql,"Register Advisor");

            return "SUCCESS";
        }

        return "USERNAME_TAKEN";
    }
}
?>