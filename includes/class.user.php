<?php
/**
 * class containing users information
 * @author wallace
 */
require_once (LIB_PATH.DS.'class.database.php');

class User {
    protected static $table_name = 'users'; // mysql database table
    protected static $db_fields = array('id', 'first_name', 'last_name', 'email_address','phone_number', 'password'); // table fields/properties
    public $id;
    public $first_name;
    public $last_name;
    public $email_address;
    public $phone_number;
    public $password;

    public static function find_all(){ //
        // find all
        return $result_set = self::find_by_sql("SELECT * FROM users");
    }

    public static function find_by_id($id=0){
        // find all but with a given id
        $result_array= self::find_by_sql("SELECT * FROM users WHERE id={$id} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array):false;
    }

    public static function find_by_sql($sql=""){
        // find by an sql statement
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while ($row = $database->fetch_array($result_set)){
            $object_array[] = self::instantiate($row);
        }

        return $object_array;
    }

    public static function authenticate($email="", $password=""){ // authenticate a user
        // supplied password is cross checked against a password stored in the database
        global $database;
        global $session;
        $sql = "SELECT * FROM users ";
        $sql .= "WHERE email_address = '".$database->escape_value($email)."' ";
        $sql .= "LIMIT 1";
        $result_array = self::find_by_sql($sql);
        // $_SESSION["result"] = $result_array;
        if(!empty($result_array)){
            $db_password = $result_array[0]->password ; //object's property
            if(password_verify($database->escape_value($password), $db_password)){
                $id = $result_array[0]->id;
                $_SESSION['user_id'] = $id;
                return true;
            }else{
                $session->message("Incorrect Password !");
            }
        }else{
                $session->message("Please Sign Up !");
            return false;
        }
    }

    public static function get_user_id($username="", $password=""){ // gets user id
        // this method will be checked in the future to ensure hashed_password is used
        global $database;
        $sql = "SELECT id FROM users ";
        $sql .= "WHERE username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";
        $result = $database->query($sql);
        while($row = mysqli_fetch_array($result)){
        $_SESSION['USER_ID'] = $row['id'];
        }

    }

    public function full_name() { // get as users full name

        if (isset($this->first_name) && isset($this->last_name)) {
           return ucfirst($this->first_name) . " " . ucfirst($this->last_name) ;
        }else{
            return "";
        }
    }

    private function instantiate($record){ // instantiate object from a database record
        $object = new self;
        foreach ($record as $attribute => $value) {
            if($object->has_attribute($attribute)){
               $object->$attribute = $value;
            }
        }

        return $object;
    }

    private function has_attribute($attribute){ // checks attributes
        $object_vars = $this->attributes(); // gets the properties of the object
        return key_exists($attribute, $object_vars);
    }

    public function attributes(){ // assigns attributes
        $attributes = array();
        foreach(self::$db_fields as $field){
            if(property_exists($this, $field)){
               $attributes [$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes(){ // preps the attributes
        global $database ;
        $clean_attribute = array();
        foreach($this->attributes() as $key => $value){
          $clean_attribute[$key] = $database->escape_value($value);
        }
        return $clean_attribute;
    }
    public function save(){
        // checking between update and create user
        // if user exist, his/her id exists in the database, otherwise the user to
        // register, a redirect is important
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create_new_user($first_name, $last_name, $email_address, $phone_number, $password) // create a new user, when a user signs up
    {
        global $database;
        $sql = "INSERT INTO ".self::$table_name." (first_name, last_name, email_address, phone_number, password) VALUES (" ;
        $sql .= "'". $database->escape_value($first_name);
        $sql .= "','".$database->escape_value($last_name);
        $sql .= "','".$database->escape_value($email_address);
        $sql .= "','".$database->escape_value($phone_number);
        $sql .= "','".$database->escape_value($password)."')";
        return $database->query($sql);

    }

    // the method below has a bug and it will be debugged , in the mean while the method above
    // be used to create new users
    public function create() {
       // creating a user
       global $database ;
       $attributes = $this->sanitized_attributes();
       $sql = "INSERT INTO ".self::$table_name." ( ";
       $sql .= join(",", array_keys($attributes));
       $sql .= " ) VALUES ( '";
       $sql .= join("' , '", array_values($attributes));
       $sql .= " ')";

       if($database->query($sql)){
           $this->id = $database->insert_id();
           return true;
       }else{
           return false;
       }
    }

    public function update() { // updates users records
        // updating user record
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach($attributes as $key => $value ){
            $attribute_pairs[] = "{$key}=>'{$value}'";
        }
        global $database;
        $sql = "UPDATE ".self::$table_name." SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id = ".$database->escape_value($this->id);

        $database->query($sql);
        return ($database->affected_rows() == 1)? true : false;
    }

    public function delete() { // delete a user
        // delete users
        global $database;
        $sql = "DELETE FROM ".self::$table_name." ";
        $sql .= " WHERE id = ".$database->escape_value($this->id);
        $sql .= " LIMIT 1 ";

        $database->query($sql);
        return ($database->affected_rows() == 1)? true : false;
    }


}

 $user = new User();
