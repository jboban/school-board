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
    private $student_id;      // JSON input data

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
    }

};

// print_r($_GET);
$student_id = $_GET['student'];
if (!$student_id) {
    die('No student id given');
}

$school_board = new SchoolBoard($student_id);
$school_board->calc();

?>
