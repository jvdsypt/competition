<?php
include "config.php";

$function = $_POST['functie'];


if($function == 'heren'){
	$sql = "SELECT name, klassement_enkel, lidnummer, geslacht FROM spelers WHERE `geslacht` = 'M'";
}
elseif($function == 'gemengd'){
	$sql = "SELECT name, klassement_enkel, lidnummer, geslacht FROM spelers";
}

$result = mysqli_query($con,$sql);

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

?>