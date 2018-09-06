<?php
require_once 'class.database.php';
/**
 * Description of Pagination
 * This is a helper class containing pagination properties and methods, it has been
 * used to paginate the images in index.php file
 * @author wallace
 */

class Photograph{

    protected static $table_name = 'photographs'; // table name
    protected static $db_fields = array('owner_id','photo_id', 'filename', 'type', 'size', 'caption'); // database fields
    public $owner_id; // database fields as class properties
    public $photo_id ;
    public $filename ;
    public $type ;
    public $size ;
    public $caption ;

    private $temp_path ; // default temporary path for uploads
    private $upload_dir = "images"; // folder to upload images
    public $errors = array(); // empty, errors will be added dynamically
    protected $upload_errors = array( // errors that may be encoutered during file upload
        UPLOAD_ERR_OK => "No errors",
        UPLOAD_ERR_INI_SIZE =>"Larger than upload_max_filesize",
        UPLOAD_ERR_FORM_SIZE =>"Larger than FORM_MAX_FILE_SIZE",
        UPLOAD_ERR_PARTIAL =>"Partial upload",
        UPLOAD_ERR_NO_FILE =>"No file",
        UPLOAD_ERR_NO_TMP_DIR => "No temporary directory",
        UPLOAD_ERR_CANT_WRITE => "Can't write to disk",
        UPLOAD_ERR_EXTENSION => "File upload stopped by extension"
    );

    public function attach_files ($file){ // attaches the attributes with temporary file details

        $this->temp_path = $file['tmp_name'];
        $this->filename = basename($file['name']);
        $this->type = $file['type'];
        $this->size = $file['size'];

        if(!$file || empty($file) || !is_array($file)){
            $this->errors[] = "No file that was uploaded";
            //possible file attack
            return false ;
        }elseif($file['error'] != 0 ){
            $this->errors[] = $this->upload_errors[$file['error']];
            return false;
        }else{
            // set attributes
            $this->temp_path = $file['tmp_name'];
            $this->filename = basename($file['name']);
            $this->type = $file['type'];
            $this->size = $file['size'];
            return true;
        }
    }

    public function save(){ // saves the photo in an image gallery
        if(isset($this->photo_id)){
            // to update a caption
            $this->update();
        }else{
            // error checking
            if(!empty($this->errors)){
                return false;
            }
            if(strlen($this->caption > 250)){ // checking the caption
                $this->errors[] = "caption cannot be longer that 250 characters";
                return false;
            }
            if(empty($this->filename) || empty($this->temp_path)){ // cheking location
                $this->errors[] = "The file location was not available";
                return false;
            }
            // /opt/lampp/htdocs/kejaport/public/images
            $target_path = SITE_ROOT .DS. 'public' .DS. $this->upload_dir .DS. $this->filename;
            if(file_exists($target_path)){ // check whether the photo already exists in the database
                $this->errors[] = "The file {$this->filename} already exists";
                return false;
            }

            if(move_uploaded_file($this->temp_path, $target_path)){ // mve uploaded file
                // if it succeeds
                if($this->create()){ //create a database entry
                    unset($this->temp_path); // unset the temp path
                    return true;
                }
            }else{
                // if it fails
                $this->errors[] = "File upload failed, maybe due to incorrect permissions on the upload folder";
            }

        }
    }

    public function destroy(){ // calls the method when deleting the file from the db and the disk
        // remove from db
        if($this->delete()){
        // remove file from disk
        $target_path = SITE_ROOT.DS.'public'.DS.$this->image_path();
        return unlink($target_path) ? true : false ; // unlink deletes the file
        }else{
            return false;
        }
    }
    public function image_path(){ // gets the image path (objects image path)
        return $this->upload_dir.DS.$this->filename;
    }

    public function image_size() { // human readable size
        // 1 bytes = 1024 kb 1megabytes = 1024 * 1024
        $bytes = 1024; // 1byt = 2^10 bits
        $megabytes = 1024 * 1024 ;
        if($this->size < $bytes){
            return "{$this->size} bytes" ;
        }elseif($this->size < $megabytes){
            $kB = round($this->size/$bytes);
            return "{$kB} KB";
        }else{
            $bytes = round($this->size/$megabytes, 1);
            return "{$bytes}MB";
        }
    }

    public function total_size($id){ // gets the total size of an owners photo
        $bytes = 1024;
        $megabytes = 1024 * 1024 ;
        global $database;

        $sql = "SELECT SUM(`size`) AS size FROM ".self::$table_name." WHERE owner_id = {$id} ";
        $result = $database->query($sql);
        $sum = mysqli_fetch_array($result)['size'] ;
        if($sum < $bytes){
            return "{$sum} bytes" ;
        }elseif($sum < $megabytes){
            $kB = round($sum/$bytes);
            return "{$kB} KB";
        }else{
            $bytes = round($sum/$megabytes, 1);
            return "{$bytes}MB";
        }
    }

    public static function find_all(){ //
        // find all the photos, the db fields are used to read the files in the disk
        return $result_set = self::find_by_sql("SELECT * FROM photographs");
    }

    public static function find_all_by_owner($owner_id){ // finding the images by the owner
        $sql = "SELECT * FROM photographs ";
        $sql .= " WHERE owner_id = {$owner_id} ";
        return $result_set = self::find_by_sql($sql);
    }

    public static function find_by_id($id=0){
        // find all but with a given id
        global $database;
        $sql = "SELECT * FROM ".self::$table_name ." " ;
        $sql .= " WHERE photo_id = ".$database->escape_value($id)." ";
        $sql .= " LIMIT 1";
        $result_array= self::find_by_sql($sql);
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

    public static function count_all(){ // computes a count of records in a database
        global $database ;
        $sql = "SELECT COUNT(*) FROM ".self::$table_name;
        $result = $database->query($sql);
        $row = $database->fetch_array($result);
        return array_shift($row);
    }

    public static function authenticate($email="", $password=""){ // to authenticate a user when the logs in
        global $database;
        global $session;
        $sql = "SELECT * FROM photographs ";
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

    public static function get_user_id($username="", $password=""){ // geta a user id given the username and password, the password is hashed password --> method not complete
        global $database;
        $sql = "SELECT id FROM photographs ";
        $sql .= "WHERE username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";
        $result = $database->query($sql);
        while($row = mysqli_fetch_array($result)){
        $_SESSION['USER_ID'] = $row['id'];
        }

    }

    public function full_name() { // gets users full name

        if (isset($this->first_name) && isset($this->last_name)) {
           return ucfirst($this->first_name) . " " . ucfirst($this->last_name) ;
        }else{
            return "";
        }
    }


    private function instantiate($record){ // instantiates objects from database records
        $object = new self;
        foreach ($record as $attribute => $value) {
            if($object->has_attribute($attribute)){
               $object->$attribute = $value;
            }
        }

        return $object;
    }

    private function has_attribute($attribute){ // checks whether the object has this class' attributes
        $object_vars = $this->attributes(); // gets the properties of the object
        return key_exists($attribute, $object_vars);
    }

    public function attributes(){ // class' attributes gets assigned from the database fields
        $attributes = array();
        foreach(self::$db_fields as $field){
            if(property_exists($this, $field)){
               $attributes [$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes(){ // sanitizing the attributes so that they can be laded into a databse
        global $database ;
        $clean_attribute = array();
        foreach($this->attributes() as $key => $value){
          $clean_attribute[$key] = $database->escape_value($value);
        }
        return $clean_attribute;
    }

    // public function save(){
    //     // checking between update and create user
    //     // if user exist, his/her id exists in the database, otherwise the user to
    //     // register, a redirect is important
    //     return isset($this->id) ? $this->update() : $this->create();
    // }

    public function create() { //create a new database entry for an uploaded photograph

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

    public function update() { // updates maybe the caption of a photograph
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

    public function delete() { // desroy method is to be used , this method will
        // delete the database entry of a photograph and the photograph will only be left in
        // the upload folder 
        global $database;
        $sql = "DELETE FROM ".self::$table_name." ";
        $sql .= " WHERE photo_id = ".$database->escape_value($this->photo_id);
        $sql .= " LIMIT 1 ";

        $database->query($sql);
        return ($database->affected_rows() == 1)? true : false;
    }
}
