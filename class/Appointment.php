<?php
class Appointment {
    public $id;
    public $date;
    public $startTime;
    public $type;
    public $location;

    public function __construct($id, $date, $startTime, $location, $type) {
        $this->id = $id;
        $this->date = $date;
        $this->startTime = $startTime;
        $this->type = $type;
        $this->location = $location;
    }
}
?>