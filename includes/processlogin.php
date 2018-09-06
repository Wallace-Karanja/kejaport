<?php require($_SERVER ["DOCUMENT_ROOT"]."/kejaport/includes/initialize.php")?>
<?php

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(!empty($email) && !empty($password)){
        if(User::authenticate($email, $password)){ // authenticate a user 
            redirect_to("../useraccount.php");
        }else{
            // $session->message ("Incorrect Email or Password");
            $_SESSION['email'] = htmlentities($email);
            redirect_to("../login.php");
        }
    }else{
        $session->message("Provide both Email and Password");
        redirect_to("../login.php");
    }
}

if(isset($_POST['logout'])){
    unset($_SESSION['user_id']);
    redirect_to("../login.php");
}
