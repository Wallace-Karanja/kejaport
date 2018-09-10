<?php require($_SERVER ["DOCUMENT_ROOT"]."/kejaport/includes/initialize.php")?>
<?php if (!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php $user_object = $user->find_by_id($_SESSION['user_id']); ?>
<?php
    $max_file_size = 5242880; // 1mb = 1024bytes * 1024bytes // the $max_file_size is 5mb
    if(isset($_POST['submit'])){
       $photo = new Photograph();
       $photo->owner_id = $_SESSION['user_id'];
       $photo->caption = $_POST['caption'];
       $photo->attach_files($_FILES['file_upload']);
       if($photo->save()){
           // success
           // save() saves the photo details in the database
           $session->message("Photograph uploaded successfully");
       }else{
           // failure
           // get the errors and give a user a message
           $session->message(join('<br>', $photo->errors));
       }
    }
?>
<?php
  // get the photos of the owner currently logged in ,
  // $_SESSION['user_id'] was created when the user logged in
   $photos = Photograph::find_all_by_owner($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Place Your Advert</title>
</head>
<body>
<h1>Welcome !</h1>
<h2>Place Your Advert</h2>
<?php echo output_message($message) ;?>
<!--log out the user -->
<form method="post" action="includes/processlogin.php">
<label><?php echo  $user_object->full_name(); ?></label>
<input type="submit" name="logout" value="Logout">
</form>
<!-- to upload photo form -->
<!-- users adverts to be completed  -->
<form>
    <table>
        <tr>
            <td>Location : <input type="text" name="location"></td>
            <td>Type of house :
                <select class="house_type" name="house_type">
                    <option></option>
                    <option>One Bedroom</option>
                    <option>Two Bedrooms</option>
                    <option>Single</option>
                    <option>Bedsitter</option>
                </select>
            </td>
        <td>Rent: KSh<input type="number" name="rent"></td>
        <td>Number of houses: <input type="number" name="house_count"></td>
        </tr>
    </table>
    <h3>Upload images for the house selected above</h3>
  </form>

  <form  action="useraccount.php" enctype="multipart/form-data" method="POST">
    <table>
        <tr>
            <td><input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size;?>"></td>
            <td><input type="file" name="file_upload"></td>
            <td>Caption:<input type="text" name="caption" value=""></td>
            <td><input type="submit" name="submit" value="upload"></td>
        </tr>
    </table>
    <?php if (!empty($photos)):?>
        <table border="1">
            <thead>
                <tr>
                     <th>Image</th>
                     <th>Caption</th>
                     <th>Size</th>
                     <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($photos as $photo):?>
                    <tr>
                        <td><img src="public/<?php echo $photo->image_path();?>" width="100"></td>
                        <td><?php echo $photo->caption ;?></td>
                        <td><?php echo $photo->image_size();?></td>
                        <td><a href="includes/deletephoto.php?id=<?php echo $photo->photo_id ;?>">Delete</a></td>
                    </tr>
                <?php endforeach ;?>
                <tr>
                    <td>Total Size</td>
                    <td></td>
                    <td><?php $photos = new Photograph(); echo $photos->total_size($_SESSION['user_id'])?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    <?php endif ;?>
</form>
</body>
</html>
