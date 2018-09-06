<?php require($_SERVER ["DOCUMENT_ROOT"]."/kejaport/includes/initialize.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Sign Up</title>
</head>
<body>
<h2>Sign Up</h2>
<form action="includes/processsignup.php" method="post">
 <table>
    <tr>
        <?php $firstname = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : "" ;?>
        <td>First Name</td>
        <td><input type="text" name="first_name" id="first_name" value="<?php echo $firstname ?>"></td>
    </tr>
    <tr>
        <?php $lastname = isset($_SESSION['lastname']) ? $_SESSION['lastname'] : "" ;?>
        <td>Last Name</td>
        <td><input type="text" name="last_name" id="last_name" value="<?php echo $lastname ?>"></td>
    </tr>
    <tr>
        <?php $email = isset($_SESSION['email']) ? $_SESSION['email'] : "" ;?>
        <td>Email Address</td>
        <td><input type="email" name="email_address" id="email" value="<?php echo $email?>"></td>
    </tr>
    <tr>
        <?php $phonenumber = isset($_SESSION['phonenumber']) ? $_SESSION['phonenumber'] : "" ;?>
        <td>Phone Number</td>
        <td><input type="text" name="phone_number" id="phone_number" value="<?php echo $phonenumber?>"></td>
    </tr>
    <tr>   
        <td>Password</td>
        <td><input type="password" name="password" id="password"></td>
    </tr>
    <tr>
        <td>Confirm Password</td>
        <td><input type="password" name="confirm_password"  id="password"></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="sign_up" value="Sign Up" id="submit"></td>
   </tr>
 </table>
</form>
<p style="color:red"><?php  echo $message ;?></p>
<p>If you have an account click the link below to log in</p>
<a href="login.php">Login</a>
</body>
</html>