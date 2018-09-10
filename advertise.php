<?php require($_SERVER ["DOCUMENT_ROOT"]."/kejaport/includes/initialize.php")?>
<?php if (!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php $user_object = $user->find_by_id($_SESSION['user_id']); ?>
<?php
    $max_file_size = 5242880; // 1mb = 1024bytes * 1024bytes // the $max_file_size is 5mb
    if(isset($_POST['upload'])){
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
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>For payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css"
    integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="javascript.js" type="text/javascript"></script>
  </head>
  <body>
    <div class="row">
      <div class="col-lg-3">

      </div>
      <div class="col-lg-6">
          <h1>Welcome !</h1>
          <h2>Place Your Advert</h2>
          <form action="advertise.php" method="post">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">&nbsp</th>
                  <th scope="col">&nbsp</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Constituency</td>
                  <td>
                      <select name="constituency" id="constituency" onchange="showUser(this.value)">
                          <option value="0">select constituency</option>
                          <?php
                            $sql = "SELECT * FROM constituencies ORDER BY id";
                            $result = $database->query($sql);
                           ?>
                    <?php while ($constituencies = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?php echo $constituencies['id'] ; ?>"><?php echo $constituencies['constituency'] ;?></option>
                    <?php } ; ?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td>Ward</td>
                  <td>
                      <select class="" name="ward" id="txtHint">
                          <option value="0">select ward</option>

                      </select>
                  </td>
                </tr>
                <tr>
                  <td> Specific Area</td>
                  <td><label><input type="text" name="specific_area"></label></td>
                </tr>
                <tr>
                  <td>Agency (optional)</td>
                  <td><label><input type="text" name="agency"></label></td>
                </tr>
                <tr>
                  <td>Type of house</td>
                  <td><select class="" name="house_type">
                      <option value="0">select house type</option>
                      <?php
                        $sql = "SELECT * FROM houses ORDER BY id";
                        $result = $database->query($sql);
                       ?>
                <?php while ($houses = mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo $houses['id'] ; ?>"><?php echo $houses['house_type'] ;?></option>
                <?php } ; ?>
                  </select>
                </td>
                </tr>
                <tr>
                  <td>Rent KSh</td>
                  <td><label><input type="number" name="rent"></label></td>
                </tr>
                <tr>
                  <td>Number of houses</td>
                  <td><label><input type="number" name="house_count"></label></td>
                </tr>
                <tr>
                  <td>Enter Payment Code</td>
                  <td><label><input type="number" name="payment_code"></label></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input type="submit" name="submit" value="submit"></td>
                </tr>
              </tbody>
            </table>
          </form>
          <!--photo uploader  -->
          <div class="row">
              <?php echo output_message($message) ;?>
              <h3>Upload images for the house above</h3>
            <form  action="advertise.php" enctype="multipart/form-data" method="POST">
              <table>
                  <tr>
                      <td><input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size;?>"></td>
                      <td><input type="file" name="file_upload"></td>
                      <td>Caption:<input type="text" name="caption" value=""></td>
                      <td><input type="submit" name="upload" value="upload"></td>
                  </tr>
              </table>
            </form>
          </div>
          <div class="row">
              <?php if (!empty($photos)): ?>
                  <?php foreach ($photos as $photo): ?>
                      <div class="col-lg-4">
                          <img src="public/<?php echo $photo->image_path();?>" class="img-fluid img-thumbnail" alt="Responsive image">
                          <?php echo "Caption : ".$photo->caption."<br>"; ?>
                          <?php echo "Image size : ".$photo->image_size()."<br>"; ?>
                          <a href="includes/deletephoto.php?id=<?php echo $photo->photo_id ;?>">Delete</a>
                      </div>
                  <?php endforeach; ?>
              <?php endif ; ?>
          </div>
      </div>

      <div class="col-lg-3">
          <!-- log out the user -->
          <form method="post" action="includes/processlogin.php">
          <label><?php echo  $user_object->full_name(); ?></label>
          <input type="submit" name="logout" value="Logout">
          </form>
      </div>
    </div>
<pre>
<?php
  if (isset($_POST['submit'])) {
      $advert = new Advertisement();
      // if (!empty($_SESSION['user_id']) && !empty($_POST['constituency']) && !empty($_POST['ward']) && !empty($_POST['specific_area']) && !empty($_POST['agency']) && !empty($_POST['house_type']) && !empty($_POST['rent']) && !empty($_POST['house_count']) && !empty($_POST['payment_code']) ) {
      //     echo "okay";
      // }else{
      //     echo "provide all values";
      // }
      $advert->user_id = $_SESSION['user_id'];
      $advert->constituency = $_POST['constituency'];
      $advert->ward = $_POST['ward'];
      $advert->specific_area = $_POST['specific_area'];
      $advert->agency = $_POST['agency'];
      $advert->house_type = $_POST['house_type'];
      $advert->rent = $_POST['rent'];
      $advert->house_count = $_POST['house_count'];
      $advert->payment_code = $_POST['payment_code'];

      $advert_array = array(
          "user_id" => $_SESSION['user_id'],
          "constituency" => $_POST['constituency'],
          "ward" => $_POST['ward'],
          "specific_area" => $_POST['specific_area'],
          "agency" => $_POST['agency'],
          "house_type" => $_POST['house_type'],
          "rent" => $_POST['rent'],
          "house_count" => $_POST['house_count'],
          "payment_code" => $_POST['payment_code']
       );

       // var_dump(array_values($advert_array));

       if (in_array("", $advert_array)) {
           echo("Provide all the values");
       }else{
           echo("Array complete");
       }


  }
 ?>
 </pre>
 <?php //echo $_GET['id']; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"
     integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>
