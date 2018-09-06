<?php
// this scripts creates a log everytime a user logs in
require_once ("initialize.php");
    $filename = SITE_ROOT.DS.'logs'.DS.'logs.txt';
    if ($handle = fopen($filename, 'w')){
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

?>
