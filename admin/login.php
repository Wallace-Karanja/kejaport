<?php require($_SERVER ["DOCUMENT_ROOT"]."/kejaport/includes/initialize.php");?>
<?php if ($session->is_logged_in()){ redirect_to("index.php");} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Admin Login</title>  <!-- to be ranamed as Login -->
</head>
<body>
 <form action="../includes/processadminlogin.php" method="post" id="form">
 <table>
   <tr>
     <td>Email</td>
     <?php $email = isset($_SESSION['email']) ? $_SESSION['email'] : "" ;?>
     <td><input type="text" name="email" id="email" value="<?=$email?>"></td>
   </tr>
   <tr>
     <td>Password</td>
     <td><input type="password" name="password" id="password"></td>
   </tr>
   <tr>
       <td></td>
       <td><input type="submit" name="login" value="Login"></td>
   </tr>
</table>
</form>
<p style="color:red"><?php  echo $message ;?></p>
</body>
</html>