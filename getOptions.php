<?php
include "config.php";

$con = mysqli_connect($hostname, $username, $password, $databaseName);

$function = $_POST['functie'];
// $function = 'check';

if($function == 'heren' || $function == 'gemengd'){
	spelers($con, $function);
}

if($function == 'check'){
	opstellingCheck($con);
}


function spelers($con, $comp) {

    if($comp == 'heren'){
		$sql = "SELECT name, klassement_enkel, lidnummer, geslacht FROM spelers WHERE `geslacht` = 'M'";
	}
	elseif($comp == 'gemengd'){
		$sql = "SELECT name, klassement_enkel, lidnummer, geslacht FROM spelers";
	}

	$result = mysqli_query($con, $sql);

	$users_arr = array();

	while( $row = mysqli_fetch_array($result) ){
	    $lidnummer = $row['lidnummer'];
	    $name = $row['name'];
	    $klassement_enkel = $row['klassement_enkel'];
	    $geslacht = $row['geslacht'];

	    $users_arr[] = array("id" => $lidnummer, "name" => $name, "klassement" => $klassement_enkel, "geslacht" => $geslacht);
	}

	// encoding array to json format
	echo json_encode($users_arr);
}


function opstellingCheck($con) {
	$spelers = $_POST['spelers'];
	// $spelers = ['50069710','0','0','0'];
	$in = '(' . implode(',', $spelers) .')';
	$sql = "SELECT * FROM `spelers` WHERE lidnummer IN ".$in;
   	$result = mysqli_query($con, $sql);
   	$users_arr = array();
	while( $row = mysqli_fetch_array($result) ){
	    $lidnummer = $row['lidnummer'];
	    $name = $row['name'];
	    $klassement_enkel = $row['klassement_enkel'];
	    $geslacht = $row['geslacht'];

	    $users_arr[] = array("id" => $lidnummer, "name" => $name, "klassement" => $klassement_enkel, "geslacht" => $geslacht);
	}

	// encoding array to json format
	echo json_encode($users_arr);
}
// if($function == 'heren' || $function == 'gemengd'){
// 	if($function == 'heren'){
// 		$sql = "SELECT name, klassement_enkel, lidnummer, geslacht FROM spelers WHERE `geslacht` = 'M'";
// 	}
// 	elseif($function == 'gemengd'){
// 		$sql = "SELECT name, klassement_enkel, lidnummer, geslacht FROM spelers";
// 	}

// 	$result = mysqli_query($con,$sql);

// 	$users_arr = array();

// 	while( $row = mysqli_fetch_array($result) ){
// 	    $lidnummer = $row['lidnummer'];
// 	    $name = $row['name'];
// 	    $klassement_enkel = $row['klassement_enkel'];
// 	    $geslacht = $row['geslacht'];

// 	    $users_arr[] = array("id" => $lidnummer, "name" => $name, "klassement" => $klassement_enkel, "geslacht" => $geslacht);
// 	}

// 	// encoding array to json format
// 	echo json_encode($users_arr);

// }


?>