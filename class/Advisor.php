<?php
require('../../class/helper/CommonMethods.php');
class Advisor {
    public $id;
    public $firstName;
    public $lastName;
    public $userName;
    private $password;
    public $email;

    public function __construct($firstName, $lastName, $username, $password, $email) {
        $this->firstName = $fn;
        $this->lastName = $ln;
        $this->userName = $un;
        $this->password = $pw;
        $this->email = $e;
    }

    public function addNewAdvisor() {
      $db = new Common(false);

      //verify advisor doesn't already exist in database
      $sql = "
      SELECT *
      FROM 'Advisor'
      WHERE 'Username' = '".$this->username."'";
      $result = $db->executeQuery($sql, "Add Advisor");

      if (mysql_num_rows($result) == 0) {
          //if no rows returned, no username found, continue with insert
          $sql = "
          INSERT INTO `Advisor`(`ID`, `Username`, `Password`, `Email`, `Salt`)
          VALUES ('','".$this->userName."','".$this->password."','".$this->email."','')
          ";
          $db->executeQuery($sql,"Register Advisor");
          echo "<script>alert('You have been added.');</script>";
      } else {
          echo "Username taken, please choose another.";
      }
    }
}
?>