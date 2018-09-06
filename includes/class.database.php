<?php
require_once (LIB_PATH.DS.'config.php'); // contains DB configurations
/**
 * Description of MySQLDatabase
 * This class contains the usual database properties and methods, i.e
 * open and close connection, query, escape_value etc .
 * @author wallace
 */

class MySQLDatabase extends DatabaseObject { // inherits from Database object
    private $connection; // connection is private
    public $last_query;

    function __construct() { // automatically instantiates the object and connect whenever a class instance is created
        $this->open_connection();
    }

    public function open_connection(){ // public function, can be called outside the class
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME); // loaded from config.php
        if(!$this->connection){
            die("Database connection failed :".mysqli_error($this->connection)); //incase of failure
        }else{
            $db_select = mysqli_select_db($this->connection, DB_NAME); //select a database
            if (!$db_select) {
               die("Database connection failed :".mysqli_error($this->connection));
            }
        }

    }

    public function close_connection(){ // close database connection
        if(isset($this->connection)){
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }

    public function query($sql){ // querying a database
        $this->last_query = $sql;
        $result = mysqli_query($this->connection, $sql);
        $this->confirm_query($result);
        return $result; // the query is fine it will return a result
    }

    public function escape_value($value){ // prepares the value to be entered in a database
        $escaped_value = mysqli_real_escape_string($this->connection, $value);
        return $escaped_value;
    }

    public function fetch_array($result){ // fetches a results in a database and returns it as an associative array , mysqli_fetch_array can also be used , the argument is from $query($sql) method
        return mysqli_fetch_assoc($result);
    }

    public function num_rows($result){
        // get the number of rows in the result
        return mysqli_num_rows($result);
    }

    public function insert_id() {
        // get the last id generated in the last query
        return mysqli_insert_id($this->connection);
    }

    public function affected_rows() {
        // get the number of the affected rows by the last query
        return mysqli_affected_rows($this->connection);
    }

    private function confirm_query($result){ // confirming f the query will return a result
        if (!$result) {
            // output message that contains a query error incase of one and the last query that has resulted the error
            $output = "Database Query Failed"."<br>". mysqli_error($this->connection);
            $output .= " <br> Last query : ".$this->last_query  ;
            die ($output);
        }
    }
}

$database = new MySQLDatabase(); // database instance
