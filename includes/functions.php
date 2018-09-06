<?php
function strip_zeros_from_date($marked_string=""){
    // remove zeros
    $no_zeros = str_replace('*0', '', $marked_string);
    //remove marks
    $cleaned_string = str_replace('*', '', $no_zeros);
    return $cleaned_string;
}

// function to redirect the pages
function redirect_to($location = NULL){ // to redirect from a page to another
    if($location !=NULL){
        header("Location: {$location}");
        exit;
    }
}

// output a message using the function
function output_message ($message=""){
    if(!empty($message)){
        return "<p>{$message}</p";
    }else{
        return "";
    }
}

// function to auto load a class, if the class path is not provided
// it must be ensured that the path is correctly provide, this method is just a fail switch
function __autoload($class_name){
    $classname = strtolower($class_name);
    $path = LIB_PATH.DS."class.{$classname}.php";
    if(file_exists($path)){
        require_once "$path";
    }else{
        die("the file {$classname}.php could not be found");
    }
}

function log_in(){ // create a log when a users logs in , this method to be checked
    $filename = '../logs/logs.txt';
    if ($handle = fopen($filename, 'r')){
    if (is_writeable($filename)){
        if ($handle = fopen($filename, 'a+')) {
            $format = $format = "%m/%d/%Y %H:%M ";
            $time = strftime($format, fileatime($filename));
            $name = isset($_POST['username'])?$_POST['username']:'null';
            $string = $time . $name ;
            fwrite($handle, $string);
            fclose($handle);
        }

    }
}
}

function login_details(){ // get login details this method to be checked 
    $filename = '../logs/logs.txt';
    $format = "%m/%d/%Y %H:%M ";
    $time = strftime($format, filectime($filename));
    $name = isset($_POST['username'])?$_POST['username']:'null';
    $string = strtolower($name).' Logged in at '.$time. "\n";
    file_put_contents($filename, $string, FILE_APPEND | LOCK_EX);
}
