<?php
class Student {
    public $firstName;
    public $lastName;
    public $studentID;
    public $email;
    public $major;

    public function __construct($firstName, $lastName, $studentID, $email, $major) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->studentID = $studentID;
        $this->email = $email;
        $this->major = $major;
    }

    public function isEmailValid() {
        return filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    }
}
?>