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
        $sb_type = $student[sb_type];
        $grades = array($student[grade1], $student[grade2], $student[grade3], $student[grade4]);
        $grades = array_filter($grades);
        $sum = 0;
        $num = 0;
        $pass = false;
        if ($sb_type == "CSM") {
            for($i = 0; $i < count($grades); $i++) {
                if ($grades[$i] > 0) {
                    $sum += $grades[$i];
                    $num++;
                }
            }
            $avg = $sum / $num;
            $pass = $avg >= 7;
        }
        else if ($sb_type == "CSMB") {
            for($i = 0; $i < count($grades); $i++) {
                if ($grades[$i] > 0) {
                    $sum += $grades[$i];
                    $num++;
                }
            }
            if ($num > 2) {
                $sum -= min($grades);
                $num--;
            }
            $avg = $sum / $num;
            $pass = max($grades) > 8;
        }
        else {
            die("Bad School Board type");
        }

        $finalResult = $pass ? "Pass" : "Fail";

        // Make result array
        $res_arr = array(
            id => $this->student_id,
            name => $student[name],
            grades => $grades,
            average => $avg,
            final_result => $finalResult
        );
        
        if ($sb_type == "CSM") {
            header("Content-Type: application/json; charset=UTF-8");
            $resData = json_encode($res_arr);
        }
        else {
            header("Content-Type: application/xml; charset=UTF-8");
            $xml = new SimpleXMLElement('<student/>');
            
            $tag_id     = $xml->addChild("id",   $res_arr[id]);
            $tag_name   = $xml->addChild("name", $res_arr[name]);
            $tag_grades = $xml->addChild("grades");
            foreach($grades as $ind => $val) {
                if (!empty($val)) {
                    $i = $ind + 1;
                    $tag_grade = $tag_grades->addChild("grade" . $i, $val);
                }
            }
            $tag_avg = $xml->addChild("average", $res_arr[average]);
            $tag_result = $xml->addChild("final_result", $res_arr[final_result]);
            $resData = $xml->asXML();
        }
        return $resData;
    }
};

$student_id = $_GET['student'];
if (!$student_id) {
    die('No student id given');
}

$school_board = new SchoolBoard($student_id);
$res = $school_board->calc();
echo $res;

?>
