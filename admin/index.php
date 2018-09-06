<?php require($_SERVER ["DOCUMENT_ROOT"]."/kejaport/includes/initialize.php")?>
<?php if (!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php $user_object = $user->find_by_id($_SESSION['user_id']); ?>
<?php 
   $photos = Photograph::find_all(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<body>
<h1>Welcome !</h1>
<?php if (!empty($photos)):?>
    <table border="1">
        <thead>
            <tr>
                 <th>Image</th>
                 <th>Filename</th>
                 <th>Caption</th>
                 <th>Size</th>
                 <th>Type</th>
                 <th>Owner Id</th>
                 <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($photos as $photo):?>
                <tr>
                    <td><img src="../public/<?php echo $photo->image_path();?>" width="100"></td>
                    <td><?php echo $photo->filename;?></td>
                    <td><?php echo $photo->caption ;?></td>
                    <td><?php echo $photo->image_size();?></td>
                    <td><?php echo $photo->type ;?></td>
                    <td><?php echo $photo->owner_id;?></td>
                    <td><a href="../includes/admindeletephoto.php?id=<?php echo $photo->photo_id ;?>">Delete</a></td>
                    </tr>
            <?php endforeach ;?>
        </tbody>
    </table>
<?php endif ;?>
<!-- to logout form -->
<form method="post" action="../includes/processadminlogin.php">
<label><?php echo  $user_object->full_name(); ?></label>
<input type="submit" name="logout" value="Logout">
</form>
</body>
</html>
