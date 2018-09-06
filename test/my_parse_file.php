<?php
$salary = $_POST['firstname'];
$house = $_POST['lastname'];
$rent = ((int)$salary * 30) / 100;

//echo $rent;

$populate = array();
$new_array=array("uthiru");
array_push($populate, $new_array);
$new_array=array("kikuyu");
array_push($populate, $new_array);
$new_array=array("westlands/kangemi");
array_push($populate, $new_array);
$new_array=array("ruiru/juja/thika road");
array_push($populate, $new_array);

$peakfare = array();
$new_array=array(70);
array_push($peakfare, $new_array);
$new_array=array(80);
array_push($peakfare, $new_array);
$new_array=array(50);
array_push($peakfare, $new_array);
$new_array=array(80);
array_push($peakfare, $new_array);

$bedsitter = 7500 - 10000;
$onebedroom = 14000 - 18000;
$twobedroom = 18000 - 25000;

if($house == "bedsitter" && $rent > 5000){
	echo 'uthiru / kikuyu';
}
else if($house == "one bedroom" && $rent > 12000){
	echo 'kikuyu / thika road';
}
else if($house == "two bedroom" && $rent > 20000){
	echo 'uthiru / kikuyu / thika road / kangemi';
}
else{
	if($house == "bedsitter" || $house == "one bedroom" || $house == "two bedroom"){
		echo 'rent "'.$rent.'" and house type "'.$house.'" not compatible';
	}
	else{
		echo 'Enter good house type';
	}
}



$count = 0;
foreach ($peakfare as $value) {
	$count = $count + 1;
}
//print_r($peakfare);
//array_push($populate[$i],$var);
//$new_array = array($i=>$var);
?>