<?php

/**
 * Description of session
 * contains session properties and methods
 * this class sets and destroys sessions 
 * @author wallace
 */
class Session {
    private $logged_in = false;
    public $user_id;
    
    public $message ;
    function __construct() { // creating the session right away
        session_start();
        $this->check_login();
        $this->check_message();
    }
     
    public function is_logged_in(){ //check the state of the user whether the user is logged in,
        // returns either true or false
        return $this->logged_in;
    }
    
    public function login($user){ // if the user is already logged in, log in the user and mark
        // logged_in true
        if($user){
            $this->user_id = $_SESSION['user_id'] = $user->id ;
            return $this->logged_in = true;
        }
    }
    
    public function logout(){ // logout the user, and unset the session and mark logged in false
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->logged_in = false ;
    }
    
    public function message($msg=""){
        if (!empty($msg)) {
            $_SESSION['message'] = $msg;
        }else{
            return $this->message;
        }
    }


    private function check_login(){ // check whether the user is logged in or not
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->logged_in = true ;
        }else{
            unset($this->user_id);
            $this->logged_in = false;
        }
    }
    
    private function check_message(){
      if(isset($_SESSION['message'])){
            $this->message = $_SESSION['message'];
          unset($_SESSION['message']);
      }else{
            $this->message;
      } 
    }
}

$session = new Session();
$message = $session->message();