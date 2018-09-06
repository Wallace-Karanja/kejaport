<?php require($_SERVER ["DOCUMENT_ROOT"]."/kejaport/includes/initialize.php")?>
<?php if (!$session->is_logged_in()){ redirect_to("../login.php");} ?>
<?php
if(empty($_GET['id'])){  // rare occurrence unless the id was not set during saving of the photo
    $session->message("No photo id was provided");
    redirect_to("../useraccount.php");
}

$photo = Photograph::find_by_id($_GET['id']);
if($photo && $photo->destroy()){ // destroy method in the class.photographs.php does the unlinking and
  // deleting of the photo from database
    $session->message("The photo {$photo->filename} was deleted"); // this object hangs around when the
    // the photo is deleted as an instance but it not in the database
    redirect_to("../useraccount.php");
}else{
    $session->message("The photo could not be deleted");// incase the http daemon doesn't own the photo,
    // chown can be used to change owner or chmod 777  
    redirect_to("../useraccount.php");
}
