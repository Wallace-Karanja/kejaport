<?php require($_SERVER ["DOCUMENT_ROOT"]."/kejaport/includes/initialize.php")?>
<?php if (!$session->is_logged_in()){ redirect_to("../login.php");} ?> // check if admin is logged in
<?php 
if(empty($_GET['id'])){
    $session->message("No photo id was provided"); // incase the photo lacks an id
    redirect_to("../admin/index.php");
}

$photo = Photograph::find_by_id($_GET['id']); // otherwise the photo is deleted
if($photo && $photo->destroy()){
    $session->message("The photo {$photo->filename} was deleted");
    redirect_to("../admin/index.php");
}else{
    $session->message("The photo could not be deleted"); //if it requires permisssion
    redirect_to("../admin/index.php");
}