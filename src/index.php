<?php

require_once 'db.php';

/**
 * Class: SchoolBoard
 */
class SchoolBoard {
    //
    // Private declarations
    //
    private $db;
    private $student_id;

    // Constructor
    public function __construct($student_id) {
        $this->student_id = $student_id;
        $this->db = new Database();
        if (!$this->db) {
            die("Could not create database object!");
        }
    }

    public function __destruct() {
        //...
    }

    public function calc() {
        $student = $this->db->getStudent($this->student_id);
        print_r($student);
        $sb_type = $student[sb_type];
        $grades = array($student[grade1], $student[grade2], $student[grade3], $student[grade4]);
        $sum = 0;
        $num = 0;
        if ($sb_type == "CSM") {
            for($i = 0; $i < count($grades); $i++) {
                if ($grades[$i] > 0) {
                    $sum += $grades[$i];
                    $num++;
                }
            }
        }
        else if ($sb_type == "CSMB") {
            for($i = 0; $i < count($grades); $i++) {
                if ($grades[$i] > 0) {
                    $sum += $grades[$i];
                    $num++;
                }
            }
            if ($num > 1) {
                $sum -= min($grades);
                $num--;
            }
        }
        else {
            die("Bad School board type");
        }
        $avg = $sum / $num;
        echo "Avg: $avg<br>";
    }

};

$student_id = $_GET['student'];
if (!$student_id) {
    die('No student id given');
}

$school_board = new SchoolBoard($student_id);
$school_board->calc();

?>
