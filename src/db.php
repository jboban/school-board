<?php

require_once 'database.inc';

/**
 * Class Database
 */
class Database
{
    // Conection handle
    private $conn;

    function __construct($server = C_DB_Host, $user = C_DB_User, $pass = C_DB_Pass, $db = C_DB_Name) {
        $this->connect($server, $user, $pass, $db);
    }

    public function __destruct() {
        $this->disconnect();
    }

    public function connection() {
        return $this->conn;
    }

    public function getStudent($student_id) {
        $sQuery = "SELECT * FROM student WHERE id = $student_id";

        $q = $this->conn->query($sQuery);
        if ($q == null) {
            die("Error: " . $this->conn->error);
        }

        $res = '';
        if ($qTmp = $q->fetch_assoc()) {
            $res = $qTmp;
        }
        mysqli_free_result($q);
        return $res;
    }
    
    /**
     * Connect to MySQL server
     */
    private function connect($server, $user, $pass, $db) {
        $this->conn = mysqli_connect($server, $user, $pass, $db);
        // Check for errors
        if (!$this->conn) {
            die("Could not connect to database!");
        }
        if ($this->conn->connect_errno > 0) {
            die('Unable to connect to database [' . $this->conn->connect_error . ']');
        }
    }

    /**
     * Disconnect from MySQL server
     */
    public function disconnect() {
        mysqli_close($this->conn);
    }
};

?>
