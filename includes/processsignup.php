<?php require($_SERVER ["DOCUMENT_ROOT"]."/kejaport/includes/initialize.php");?>
<?php
// $sessions have been used to echo back the user input, to prevent the user from having to retype every detail they entered incase a password was not verified
// this script will be reviewed and improved
$first_name = (isset($_POST['first_name'])) ? $_POST['first_name'] : "";
$last_name = (isset($_POST['last_name'])) ? $_POST['last_name'] : "";
$email_address = (isset($_POST['email_address'])) ? $_POST['email_address'] : "";
$phone_number = (isset($_POST['phone_number'])) ? $_POST['phone_number'] : "";
$password = (isset($_POST['password'])) ? $_POST['password'] : "";
$confirm_password = (isset($_POST['confirm_password'])) ? $_POST['confirm_password'] : "";

if(empty($first_name) || empty($last_name) || empty($email_address) || empty($phone_number)
|| empty($password) || empty($confirm_password)){
    $message = $session->message("Provide all the details");
    $_SESSION['firstname'] = htmlentities($first_name);
    $_SESSION['lastname'] = htmlentities($last_name);
    $_SESSION['email'] = htmlentities($email_address);
    $_SESSION['phonenumber'] = htmlentities($phone_number);
    redirect_to("../signup.php");
}else{
    if($password == $confirm_password){
        // prepare for database entry
        $firstname = strtolower(trim($first_name));
        $lastname = strtolower(trim($last_name));
        $emailaddress = trim($email_address);
        $phonenumber = trim($phone_number);
        $hashed_password = password_hash(trim($password), PASSWORD_DEFAULT); // hashing the password
        $sql = "SELECT * FROM users WHERE email_address = '".$database->escape_value($emailaddress)."'";
        $database->query($sql);
        if(empty($database->affected_rows())){ // if there is no record sign up the user

            $user->first_name = $firstname ;
            $user->last_name = $lastname ;
            $user->email_address = $emailaddress;
            $user->phone_number = $phonenumber ;
            $user->password = $hashed_password ;
            $user->create();
            //if successiful no sessions will be sets
            redirect_to("../login.php");
        }else{
            $session->message("You already have an account , click the link below to Log in !");
            $_SESSION['firstname'] = htmlentities($first_name);
            $_SESSION['lastname'] = htmlentities($last_name);
            $_SESSION['email'] = htmlentities($email_address);
            $_SESSION['phonenumber'] = htmlentities($phone_number);
            redirect_to("../signup.php");

        }

    }else{
        $message = $session->message("Password and Confirm password do not match !");
        $_SESSION['firstname'] = htmlentities($first_name);
        $_SESSION['lastname'] = htmlentities($last_name);
        $_SESSION['email'] = htmlentities($email_address);
        $_SESSION['phonenumber'] = htmlentities($phone_number);
        redirect_to("../signup.php");
    }
}
