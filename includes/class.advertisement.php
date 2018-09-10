<?php
    /**
    *  description of Advertisement
     *@author wallace
     */
     require_once (LIB_PATH.DS.'class.database.php');

    class Advertisement{

        protected static $table_name = 'advertisements'; // mysql database table
        protected static $db_fields = array('user_id', 'constituency', 'ward','specific_area', 'agency', 'house_type', 'rent', 'house_count', 'payment_code'); // table fields/properties

        public $id;
        public $user_id ;
        public $constituency ;
        public $ward ;
        public $specific_area ;
        public $agency ;
        public $house_type ;
        public $rent ;
        public $house_count ;
        public $payment_code ;


        public static function find_all(){ //
            // find all
            return $result_set = self::find_by_sql("SELECT * FROM ".self::$table_name." ");
        }

        public static function find_by_id($id=0){
            // find all but with a given id
            $result_array= self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id = {$id} LIMIT 1");
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
            // checking between update and create advert
            // if advert exist, his/her id exists in the database, otherwise the advert to
            // register, a redirect is important
            return isset($this->id) ? $this->update() : $this->create();
        }

        public function create() {
           // creating an advert
           global $database ;
           $attributes = $this->sanitized_attributes();
           $sql = "INSERT INTO ".self::$table_name." ( ";
           $sql .= join(",", array_keys($attributes));
           $sql .= " ) VALUES ( ' ";
           $sql .= join("' , '", array_values($attributes));
           $sql .= "')";

           if($database->query($sql)){
               $this->id = $database->insert_id();
               return true;
           }else{
               return false;
           }
        }

        public function update() { // updates advert records
            // updating advert record
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

        public function delete() { // delete a advert
            // delete adverts
            global $database;
            $sql = "DELETE FROM ".self::$table_name." ";
            $sql .= " WHERE id = ".$database->escape_value($this->id);
            $sql .= " LIMIT 1 ";

            $database->query($sql);
            return ($database->affected_rows() == 1)? true : false;
        }


}

 ?>
