<?php
$q = intval($_GET['q']);
$_SESSION['q'] = $q ;
$con = mysqli_connect('localhost','kejaport','kejaport254','kejaport');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//var_dump(mysqli_select_db($con,"locationData"));

$sql="SELECT * FROM wards WHERE constituency_id = '".$q."'";
$result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option name='ward' value=\"$row[id]\" >".$row['ward']."</option>";
    }

 ?>
