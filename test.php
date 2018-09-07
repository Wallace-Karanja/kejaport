<?php require($_SERVER ["DOCUMENT_ROOT"]."/kejaport/includes/initialize.php");?>
<?php
  // echo $_SERVER['DOCUMENT_ROOT']; // document root
 ?>
 <?php
    $sql = "SELECT * FROM constituencies ORDER BY id";
    $result = $database->query($sql);
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
  </head>
  <body>
    <div class="row">
      <div class="col-lg-3">

      </div>
      <div class="col-lg-6">
          <form action="test.php" method="post">
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
                      <select name="constituency">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?php echo $row['id'] ; ?>"><?php echo $row['constituency'] ;?></option>
                    <?php } ; ?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td>Ward</td>
                  <td><input></td>
                </tr>
                <tr>
                  <td>Area</td>
                  <td><input></td>
                </tr>
                <tr>
                  <td>Agency (optional)</td>
                  <td><input type="text" name="agency"></td>
                </tr>
                <tr>
                  <td>Type of house</td>
                  <td> <select class="" name="house_type">
                    <option value="1">Single</option>
                    <option value="2">Bedsitter</option>
                    <option value="3">One Bedroom</option>
                    <option value="4">Two Bedrooms</option>
                  </select>
                </td>
                </tr>
                <tr>
                  <td>Rent</td>
                  <td><input type="number" name="rent"></td>
                </tr>
                <tr>
                  <td>Number of houses</td>
                  <td><input type="number" name="house_count"></td>
                </tr>
                <tr>
                  <td>Enter Payment Code</td>
                  <td><input type="number" name="code"></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input type="submit" name="submit" value="SUBMIT ADVERT"></td>
                </tr>
              </tbody>

            </table>
          </form>
      </div>
      <div class="col-lg-3">

      </div>
    </div>

<?php
  if (isset($_POST['submit'])) {
      var_dump($_POST);
  }
 ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"
     integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>
