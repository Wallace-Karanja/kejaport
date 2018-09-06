<?php require($_SERVER ["DOCUMENT_ROOT"]."/kejaport/includes/initialize.php")?>
<?php

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(!empty($email) && !empty($password)){
        if(User::authenticate($email, $password)){ // a different db will be required to authenticate an admin
            redirect_to("../admin/index.php");
        }else{
            // $session->message ("Incorrect Email or Password");
            $_SESSION['email'] = htmlentities($email);
            redirect_to("../admin/login.php");
        }
    }else{
        $session->message("Provide both Email and Password");
        redirect_to("../admin/login.php");
    }
}

if(isset($_POST['logout'])){
    unset($_SESSION['user_id']);
    redirect_to("../admin/login.php");
}
